<template>
    <main style="height: 100vh;">



            <div class="row" style="margin-top: 70px">
                <div class="col">
                    <div class="float-end">
                    <button class="btn btn-primary" @click="openModal"><i class="fas fa-plus"></i> Add Task</button>

                    </div>
                </div>

            </div>




    <div class="row">


        <div class="col-md-4 col-md-offset-2">
            <section class="task-area" style="background-color: navy;">
                <header>Tasks List</header>
                <draggable class="drag-area" :list="tasksList" :options="{animation:200, group:'status'}" :element="'article'" @add="moveTaskToOtherArea($event, 0)"  @change="update">
                    <article class="card" v-for="(task, index) in tasksList" :key="task.id" :task-id="task.id">
                        <header>
                            {{ task.title }}


                        </header>

                    </article>

                </draggable>
            </section>
        </div>



        <div class="col-md-4 col-md-offset-2">
            <section class="task-area" style="background-color: darkorange;">
                <header>In Progress Tasks</header>
                <draggable class="drag-area" :list="tasksInProgress" :options="{animation:200, group:'status'}" :element="'article'" @add="moveTaskToOtherArea($event, 1)"  @change="update">
                    <article class="card" v-for="(task, index) in tasksInProgress" :key="task.id" :task-id="task.id">
                        <header>
                            {{ task.title }}


                        </header>

                    </article>

                </draggable>
            </section>
        </div>
        <div class="col-md-4">
            <section class="task-area" style="background-color: green;">
                <header>Completed Tasks</header>
                <draggable class="drag-area"  :list="completedTasksList" :options="{animation:200, group:'status'}" :element="'article'" @add="moveTaskToOtherArea($event, 2)"  @change="update">
                    <article class="card" v-for="(task, index) in completedTasksList" :key="task.id" :task-id="task.id">
                        <header>
                            <strike>{{ task.title }}</strike>
                        </header>
                    </article>
                </draggable>
            </section>
        </div>
    </div>


        <!-- Modal -->
        <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addTask()">
                            <div class="form-group">
                                <input
                                    v-model="form.taskTitle"
                                    :class="{ 'is-invalid': form.errors.has('taskTitle') }"
                                    type="text"
                                    name="name"
                                    id="taskTitle"
                                    placeholder="Task Title"
                                    class="form-control"
                                />
                                <has-error :form="form" field="taskTitle"></has-error>
                            </div>

                            <div class="modal-footer">

                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    </main>
</template>

<script>
    import draggable from 'vuedraggable'

    export default {
        name: "ToDo",
        components: {
            draggable
        },
        props: ['tasksCompleted', 'tasksNotCompleted'],
        data() {
            return {

                tasksInProgress: this.tasksInProgress,
                completedTasksList: this.tasksCompleted,
                tasksList: this.tasksList,


                form: new Form({
                    id:"",
                    taskTitle:""
                })

            }
        },
        methods: {

            addTask(){
              this.form.post('addTask').then((response)=>{
                  Toast.fire({
                      icon: 'success',
                      title: response.data
                  })
                  $("#addTaskModal").modal("hide");
                  this.form.reset();
                  this.getTasks();
              })
            },

            openModal(){
                $("#addTaskModal").modal("show");
            },


            getTasks(){


                axios.get('/tasks').then((data) => {
                    this.completedTasksList = data.data[0];
                    this.tasksInProgress = data.data[1]
                    this.tasksList = data.data[2]

                })
            },
            moveTaskToOtherArea(event, status) {
                let id = event.item.getAttribute('task-id');

                axios.patch('/tasks/' + id, {
                    status: status
                }).then((response) => {
                    // console.log(response.data);
                    Toast.fire({
                        icon: 'success',
                        title: response.data
                    })
                }).catch((error) => {
                    // console.log(error);
                    Toast.fire({
                        icon: 'error',
                        title: response.data
                    })
                })
            },
            update() {
                this.tasksInProgress.map((task, index) => {
                    task.order = index + 1;
                });

                this.completedTasksList.map((task, index) => {
                    task.order = index + 1;
                });

                this.tasksList.map((task, index) => {
                    task.order = index + 1;
                });

                let tasks = this.tasksInProgress.concat(this.completedTasksList,this.tasksList);



                axios.put('/tasks/updateAll', {

                    tasks: tasks
                }).then((response) => {
                    // console.log(response.data);

                }).catch((error) => {
                    // console.log(error);
                })
            }

        },created() {
            this.getTasks();

        }
    }
</script>

<style>
    .task-area {

        border-radius: 3px;
        margin: 5px 5px;
        padding: 10px;
        width: 100%;
    }
    .task-area>header {
        font-weight: bold;
        color: white;
        text-align: center;
        font-size: 20px;
        line-height: 28px;
        cursor: grab;
    }
    .task-area article {
        border-radius: 3px;
        margin-top: 10px;
    }

    .task-area .card {
        background-color: #FFF;
        border-bottom: 1px solid #CCC;
        padding: 15px 10px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bolder;
    }
    .task-area .card:hover {
        background-color: #F0F0F0;
    }
    .drag-area{
        min-height: 10px;
    }
</style>
