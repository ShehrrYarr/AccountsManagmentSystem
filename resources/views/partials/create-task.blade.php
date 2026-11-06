<!-- Create Task -->
<div class="modal fade" id="addTasksModal" tabindex="-1" aria-labelledby="addTasksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTasksModalLabel">Create Task</h1>
                <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-large-line fw-semibold"></i>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-borderless align-middle w-100">
                    <tr>
                        <td class="w-96px">
                            <label class="form-label" for="task-task">Task Name</label>
                        </td>
                        <td>
                            <input class="form-control w-100" id="task-task" placeholder="Edit Task Detail" value="Write Documentation for New API Feature">
                        </td>
                    </tr>
                    <tr>
                        <td class="w-96px">
                            <label class="form-label">Assignee</label>
                        </td>
                        <td>
                            <input class="form-control d-flex align-items-center w-100" data-name="team-members" name="tags" placeholder="Select Memeber" value="Emma Smith">
                        </td>
                    </tr>
                    <tr>
                        <td class="w-96px">
                            <label class="form-label" for="basic-date-picker">Due Date</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="basic-date-picker" placeholder="Select a date">
                        </td>
                    </tr>
                    <tr>
                        <td class="w-96px">
                            <label class="form-label" for="creat-task-projects">Projects</label>
                        </td>
                        <td>
                            <select id="creat-task-projects" class="form-select">
                                <optgroup label="Recent">
                                    <option value="Herozi">Herozi - Bootstrap</option>
                                    <option value="QuickFrame">QuickFrame - Tailwind</option>
                                </optgroup>
                                <optgroup label="All Projects">
                                    <option value="Kalles">Kalles - eCommerce</option>
                                    <option value="Jobi">Jobi - Job Portal</option>
                                    <option value="Mosso">Mosso - Portfolio</option>
                                </optgroup>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-96px">
                            <label class="form-label" for="creat-task-status-select">Status</label>
                        </td>
                        <td>
                            <select id="creat-task-status-select" class="form-select">
                                <option value="todo">Todo</option>
                                <option value="inProgress" selected>In Progress</option>
                                <option value="bug">Bug</option>
                                <option value="onHold">On Hold</option>
                                <option value="done">Done</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-96px">
                            <label class="form-label" for="creat-task-priority-select">Priority</label>
                        </td>
                        <td>
                            <select id="creat-task-priority-select" class="form-select">
                                <option value="High" selected>High</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label class="form-label" for="taskDescriptions0">Description</label>
                            <textarea placeholder="Add your description..." rows="4" class="form-control" name="descriptions" id="taskDescriptions0"></textarea>
                            <div id="taskDescriptions2" class="form-text">This is hint text to help user.</div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
