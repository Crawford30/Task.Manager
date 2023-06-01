<template>
<div class="dvd-view">
    <div class="container">
        <div class="row my-3">
            <div class="col-md-9 text-left">
                <h4>Tasks</h4>
            </div>

            <div class="col-md-3">
                <div class="btn-group add-new-dropdown" style="width: 100%">
                    <div class="btn-group w-100" role="group">
                        <button type="button" class="btn btn-primary" @click="showAddSingleTaskModal">
                            Create Task
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <!-- <div class="col-11 ml-0 pl-0" v-if="checkPermission(current_user)"> -->
            <div class="staff-card shadow-sm table-padding">

                <div class="row justify-content-center">

                    <table class="table table-sm present-tense-table" >

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>TASK #</th>
                                <th class="text-left">TASK NAME</th>
                                <th>DATE CREATED</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody is="draggable" :list="allUserTasks.results" tag="tbody">
                        <!-- <draggable :list="allUserTasks.results" class="dragged">-->
                        <tr v-for="(
                                    userTask, index
                                ) in allUserTasks.results" :key="userTask.id + '_' + index" class="task-row">
                            <td>{{ index + 1 }}</td>
                            <td>{{ userTask.task_reference_number }}</td>
                            <td class="text-left">
                                {{ userTask.task_name }}
                            </td>
                            <td>
                                {{ userTask.created_at | myDate }}
                            </td>
                            <td>
                                <a href="#" @click="updateTask(userTask)">
                                    <i class="fas fa-pencil-alt" style="color: #999; font-size: 18px"></i>
                                </a>

                                <a href="#" @click="deleteTask(userTask.id)" style="margin-left: 8px">
                                    <i class="far fa-trash-alt" style="color: #999; font-size: 18px"></i>
                                </a>

                                <a href="#" @click="
                                            viewTaskDetail(userTask)
                                        " style="margin-left: 8px">
                                    <i class="fas fa-ellipsis-v" style="color: #999; font-size: 18px"></i>
                                </a>

                                <span style="cursor:move; margin-left: 8px">
                                    <!-- <i class="fas fa-grip-lines-vertical" style="color: #999; font-size: 18px"></i> -->
                                    <i class="fas fa-ellipsis-v" style="color: #999; font-size: 18px"></i>
                                         <i title="Drag and move to reorder" class="fas fa-grip-vertical" style="font-size: 15px; color: #999;"></i>
                                 </span>

                            </td>
                        </tr>
                    <!-- </draggable> -->
                    </tbody>


                    </table>

                </div>

                <!-- </div> -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="single-task-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <button type="button" style="
                                position: absolute;
                                right: 1.5rem;
                                top: 1.5rem;
                            " class="close" @click="closeModel">
                        &times;
                    </button>
                    <div v-show="!editmode">
                        <h5 style="text-align: center; font-weight: bold">
                            Create New Project
                        </h5>
                    </div>
                    <div v-show="editmode">
                        <h5 style="text-align: center; font-weight: bold">
                            Update Project
                        </h5>
                    </div>

                    <br />
                    <hr />

                    <form id="task-form" ref="taskRef">
                        <input hidden name="id" v-if="selectedTask != null" :value="selectedTask.id" />

                        <div class="form-group mt-2">
                            <label>Project Name:</label>
                            <v-select class="input-grouped-v-select mt-1" @input="handleValueChanged" required placeholder="Select Project Type" label="project_name" v-model="selectedProject" :options="allUserProjects.results" :clearable="false"></v-select>
                        </div>

                        <div class="form-group">
                            <label>Task Name</label>
                            <input v-if="selectedTask != null" :value="selectedTask.task_name" name="task_name" type="text" class="form-control" autocomplete="off" placeholder="Task Name" required />
                            <input v-else v-model="taskName" name="task_name" type="text" class="form-control" autocomplete="off" placeholder="Task Name" required />
                        </div>
                        <!-- <p style="color: red">Song number is required {{ taskName }}</p> -->

                        <div class="form-group">
                            <label for="">Task Priority</label>
                            <input  @keypress="onlyNumber" v-if="selectedTask != null" :value="selectedTask.task_priority" name="task_priority" type="text" class="form-control" autocomplete="off" placeholder="Task Priority" required />
                            <input @keypress="onlyNumber" v-else v-model.number="taskPriority" name="task_priority" type="text" class="form-control" autocomplete="off" placeholder="Task Priority" required />
                        </div>
                    </form>

                    <div class="row d-flex justify-content-center">
                        <div class="col-4 px-6">
                            <div class="text-center mt-2">
                                <button type="button" class="present-tense-btn present-tense-secondary" @click="closeModel">
                                    <span> CLOSE</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center mt-2">
                                <button :disabled="isProcessing" type="button" class="present-tense-btn present-tense-primary" @click="saveTask">
                                    <i v-if="isProcessing" id="sendlog-spinner-spinner" class="fa fa-spinner fa-spin"></i>
                                    <span> SAVE</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-------Add Single task  End------>

    <!-------View Single  task Detail------>
    <div class="modal fade" id="single-task-modal-detail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <button type="button" style="
                                position: absolute;
                                right: 1.5rem;
                                top: 1.5rem;
                            " class="close" @click="closeModel">
                        &times;
                    </button>
                    <h5 style="text-align: center; font-weight: bold">
                        Task Details
                    </h5>

                    <br />
                    <hr />

                    <form id="task-form" ref="taskRef">
                        <div class="form-group">
                            <vue-editor id="task-body" :disabled="true" v-model="taskName" :editorToolbar="defaultToolbar"></vue-editor>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-------View Single Song  End------>

</div>
</template>

<script>
import {
    VueEditor
} from "vue2-editor";
import Swal from "sweetalert2";
import draggable from 'vuedraggable';

export default {
    components: {
        VueEditor,
        draggable
    },
    mixins: [],
    data() {
        return {
            dragging: false,
            selectedProject: null,
            file: null,
            editmode: false,
            selectedTask: null,
            hasFile: false,
            allUserTasks: [],
            allUserProjects: [],

            isProcessing: false,
            songTitle: "",
            songBody: "",
            taskName: "",
            taskPriority: "",
            errors: null,
            importResults: {},
            defaultToolbar: [
                [{
                    header: [false, 1, 2, 3, 4, 5, 6],
                }, ],
                ["bold", "italic", "underline", "strike"],
                [{
                        align: "",
                    },
                    {
                        align: "center",
                    },
                    {
                        align: "right",
                    },
                    {
                        align: "justify",
                    },
                ],
                [{
                        list: "ordered",
                    },
                    {
                        list: "bullet",
                    },
                ],
                [{
                        indent: "-1",
                    },
                    {
                        indent: "+1",
                    },
                ],
            ],
        };
    },

    mounted() {
        let app = this;
        app.getAllProjects();
        app.getAllTasks();

    },
    methods: {

        onlyNumber($event) {
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
                $event.preventDefault();
            }
        },

        handleValueChanged(value) {
            this.selectedProject = value;
        },


        saveTask() {
            let app = this;
            let form = $("#task-form");
            let formModal = $("#single-task-model");

            let taskFormData = new FormData();
            if (this.editmode) {
                taskFormData.append("task_id", this.selectedProject.id),
                    taskFormData.append("task_name", this.selectedProject.task_name),
                    taskFormData.append("task_priority", this.selectedProject.task_priority),
                    taskFormData.append("project_id", this.selectedProject.id)

            } else {
                taskFormData.append("project_id", this.selectedProject.id),
                 taskFormData.append("task_name", this.taskName),
                taskFormData.append("task_priority", this.taskPriority)

            }

            if (form.valid()) {
                app.isProcessing = true;
                //console.log("SERIALIZED: ", form.serialize());
                axios({
                        method: "post",
                        url: "/api/task/create-task",
                        data: taskFormData,
                        //form.serialize(),
                    })
                    .then((response) => {
                        app.isProcessing = false;
                        app.getAllTasks();
                        formModal.modal("hide");
                        //======dismiss the model
                        this.closeModel();
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            html: "<p class='font-size: 13px'>Task Successfully Added</p>",
                            showConfirmButton: true,
                            allowOutsideClick: false,
                            showCloseButton: true,
                            confirmButtonText: "Ok",
                            confirmButtonColor: "#32CD32",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // window.location.href = "/list";
                            }
                        });
                    })
                    .catch((error) => {
                        app.isProcessing = false;
                        this.errors = error.response.data.errors;
                        formModal.modal("hide");
                        //app.showErrorMessage(error.response.data.errors);
                    });
            }

        },

        saveSong() {
            let app = this;
            let form = $("#task-form");
            let formModal = $("#single-task-modal");

            let songFormData = new FormData();
            if (this.editmode) {
                songFormData.append("song_id", this.selectedTask.id),
                    songFormData.append(
                        "task_name",
                        this.selectedTask.task_name
                    ),
                    songFormData.append("song_title", this.songTitle),
                    songFormData.append("song_body", this.songBody);
            } else {
                songFormData.append("task_name", this.taskName),
                    songFormData.append("song_title", this.songTitle),
                    songFormData.append("song_body", this.songBody);
            }

            if (form.valid()) {
                app.isProcessing = true;
                //console.log("SERIALIZED: ", form.serialize());
                axios({
                        method: "post",
                        url: "/api/present-tense/create-present-tense-song",
                        data: songFormData,
                        //form.serialize(),
                    })
                    .then((response) => {
                        app.isProcessing = false;
                        app.getAllTasks();
                        formModal.modal("hide");
                        //======dismiss the model
                        this.closeModel();
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            html: "<p class='font-size: 13px'>Song Successfully Submitted</p>",
                            showConfirmButton: true,
                            allowOutsideClick: false,
                            showCloseButton: true,
                            confirmButtonText: "Ok",
                            confirmButtonColor: "#32CD32",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // window.location.href = "/list";
                            }
                        });
                    })
                    .catch((error) => {
                        app.isProcessing = false;
                        this.errors = error.response.data.errors;
                        formModal.modal("hide");
                        app.showErrorMessage(error.response.data.errors);
                    });
            }
        },

        updateTask(item) {
            let app = this;
            app.editmode = true;
            app.selectedTask = item;
            app.taskName = item.task_name;
            app.taskPriority = item.task_priority;
            $("#single-task-modal").modal("show");
        },

        viewTaskDetail(item) {
            let app = this;
            app.editmode = true;
            app.selectedTask = item;
            app.taskName = item.task_name;
            app.taskPriority = item.task_priority
            $("#single-task-modal-detail").modal("show");
        },

        deleteTask(id) {
            let app = this;
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "api/task/delete-task",
                        type: "post",
                        data: {
                            task_id: id,
                        },
                        success(data) {
                            Swal.fire(
                                "<p style='font-size: 14px;'>Task Deleted Successfully</p>",
                                "",
                                "success"
                            );
                            app.getAllTasks();
                        },
                        error(e) {
                            //   app.showAjaxError(e);
                        },
                    });
                }
            });
        },

        getAllTasks() {
            let app = this;
            axios
                .get("api/task/list")
                .then((response) => {
                    app.allUserTasks = response.data;
                })
                .catch((error) => {
                    //   app.showErrorMessage(error.response.data);
                });
        },

        getAllProjects() {
            let app = this;
            axios
                .get("api/project/list")
                .then((response) => {
                    // console.log("response....: ", response)
                    app.allUserProjects = response.data;
                })
                .catch((error) => {
                    //   app.showErrorMessage(error.response.data);
                });

            // console.log("PRO....: ", this.allUserProjects)
        },







        showAddSingleTaskModal() {
            let app = this;
            app.selectedTask = null;
            (app.songBody = ""),
            (app.songTitle = ""),
            $("#single-task-modal").modal("show");
        },

        closeModel() {
            $("#single-task-modal").modal("hide");
            $("#single-task-modal-detail").modal("hide");
        },

        closeDialog() {
            let app = this;
            app.file = null;
            app.hasFile = false;
            app.isProcessing = false;
            $("#modal-upload-song-excel").modal("hide");
        },
    },
};
</script>

<style lang="scss" scoped>
.present-tense-table th,
.present-tense-table tr.task-row {
    font-size: 13px !important;
}



#song-title .ql-editor {
    height: 20px;
}

.dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid;
    border-right: 0.3em solid transparent;
    border-bottom: 0;
    border-left: 0.3em solid transparent;
    //   float: right !important;
    margin-top: 8px !important;
    margin-right: 5px;
}

.img-logo {
    height: 30px !important;
}

.dropdown-menu {
    min-width: 8rem !important;
}

.container {
    text-align: center;
}

.progress-container {
    display: flex;
    justify-content: space-between;
    position: relative;
    max-width: 100%;
    width: 150px;
    margin-bottom: 2.5em;

    &::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        height: 4px;
        width: 150px;
        background-color: #bdbdbd;
        z-index: 1;
    }
}

.progress-indicator {
    position: absolute;
    top: 50%;
    left: 0;
    width: 0;
    height: 4px;
    background-color: #2c6ec8;
    z-index: 1;
    transition: all 0.5s ease-in;
}

.circle-item {
    background-color: #fff;
    height: 20px;
    width: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 2px solid #bdbdbd;
    border-radius: 50%;
    transition: all 0.4s ease-in;
    z-index: 2;

    &.completed {
        border-color: #2c6ec8;
        background-color: #2c6ec8;
        color: #fff;
        box-shadow: 0 0 31px -2px rgba(44, 110, 200, 0.62);
    }
}

.done {
    width: 100% !important;
}

.alert-dismissible .close {
    position: absolute;
    top: 0;
    z-index: 2;
    padding: 0.75rem 1.25rem;
    color: inherit;
    left: 0;
    margin-right: 30px;
}

.alert {
    position: relative;
    padding: 0.75rem 3.95rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
    text-align: left;
}

#loader {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    width: 50px;
    height: 50px;
    margin: 1px 0 0 -26px;
    border: 8px solid #f3f3f3;
    border-radius: 50%;
    border-top: 8px solid #3498db;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.hideLoader {
    display: none;
}

.v-select .dropdown li {
    border-bottom: 1px solid rgba(112, 128, 144, 0.1);
}

.v-select .dropdown li:last-child {
    border-bottom: none;
}

.v-select .dropdown li a {
    padding: 10px 20px;
    width: 100%;
    font-size: 1.25em;
    color: #3c3c3c;
}

.v-select .dropdown-menu .active>a {
    color: #fff;
}

::-webkit-scrollbar {
    width: 10px;
}
</style>
