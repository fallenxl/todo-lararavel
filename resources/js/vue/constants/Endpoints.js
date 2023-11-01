const BASE_URL = 'http://localhost:8000/api';

export const Endpoints = {
    ALL_TASKS: `${BASE_URL}/tasks`,
    CREATE_TASK: `${BASE_URL}/task/store`,
    TASK: `${BASE_URL}/task/`,
    DELETE_ALL_TASKS: `${BASE_URL}/tasks/all`,
    DELETE_SELECTED_TASKS: `${BASE_URL}/tasks/selected`,
}
