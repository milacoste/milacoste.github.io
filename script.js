document.addEventListener('DOMContentLoaded', function() {
    const taskInput = document.getElementById('taskInput');
    const taskDate = document.getElementById('taskDate');
    const taskPriority = document.getElementById('taskPriority');
    const addTaskBtn = document.getElementById('addTaskBtn');
    const taskList = document.getElementById('taskList');
    const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
    const sortByDateBtn = document.getElementById('sortByDateBtn');
    const filterPriority = document.getElementById('filterPriority');
    
    let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    
    // Отображение задач
    function renderTasks() {
        taskList.innerHTML = '';
        const filterValue = filterPriority.value;
        
        const filteredTasks = filterValue === 'all' 
            ? tasks 
            : tasks.filter(task => task.priority === filterValue);
        
        filteredTasks.forEach((task, index) => {
            const li = document.createElement('li');
            li.className = `task-item ${task.completed ? 'completed' : ''}`;
            li.dataset.priority = task.priority;
            
            li.innerHTML = `
                <input type="checkbox" class="task-checkbox" ${task.completed ? 'checked' : ''} data-index="${index}">
                <span class="task-text">${task.text}</span>
                <span class="task-date">${task.date || 'Без даты'}</span>
                <span class="task-priority ${task.priority}">${getPriorityLabel(task.priority)}</span>
                <button class="up-btn" data-index="${index}">↑</button>
                <button class="down-btn" data-index="${index}">↓</button>
                <button class="delete-btn" data-index="${index}">Удалить</button>
            `;
            
            taskList.appendChild(li);
        });
    }
    
    function getPriorityLabel(priority) {
        switch(priority) {
            case 'high': return 'Высокий';
            case 'medium': return 'Средний';
            case 'low': return 'Низкий';
            default: return '';
        }
    }
    
    // Добавление задачи
    function addTask() {
        const text = taskInput.value.trim();
        const date = taskDate.value;
        const priority = taskPriority.value;
        
        if (text) {
            tasks.push({
                text,
                date,
                priority,
                completed: false
            });
            
            saveTasks();
            renderTasks();
            
            taskInput.value = '';
            taskDate.value = '';
            taskPriority.value = 'medium';
        }
    }
    
    // Сохранение задач в localStorage
    function saveTasks() {
        localStorage.setItem('tasks', JSON.stringify(tasks));
    }
    
    // Удаление выделенных задач
    function deleteSelected() {
        const checkboxes = document.querySelectorAll('.task-checkbox:checked');
        const indexesToDelete = Array.from(checkboxes).map(checkbox => parseInt(checkbox.dataset.index));
        
        tasks = tasks.filter((_, index) => !indexesToDelete.includes(index));
        saveTasks();
        renderTasks();
    }
    
    // Сортировка по дате
    function sortByDate() {
        tasks.sort((a, b) => {
            if (!a.date && !b.date) return 0;
            if (!a.date) return 1;
            if (!b.date) return -1;
            return new Date(a.date) - new Date(b.date);
        });
        
        saveTasks();
        renderTasks();
    }
    
    // Обработчики событий
    addTaskBtn.addEventListener('click', addTask);
    taskInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') addTask();
    });
    
    deleteSelectedBtn.addEventListener('click', deleteSelected);
    sortByDateBtn.addEventListener('click', sortByDate);
    filterPriority.addEventListener('change', renderTasks);
    
    // Делегирование событий для чекбоксов и кнопок удаления
    taskList.addEventListener('click', function(e) {
        if (e.target.classList.contains('task-checkbox')) {
            const index = parseInt(e.target.dataset.index);
            tasks[index].completed = e.target.checked;
            saveTasks();
            renderTasks();
        }
        
        if (e.target.classList.contains('delete-btn')) {
            const index = parseInt(e.target.dataset.index);
            tasks.splice(index, 1);
            saveTasks();
            renderTasks();
        }
        
        if (e.target.classList.contains('up-btn')) {
            const index = parseInt(e.target.dataset.index);
            if (index > 0) {
                [tasks[index], tasks[index-1]] = [tasks[index-1], tasks[index]];
                saveTasks();
                renderTasks();
            }
        }
        
        if (e.target.classList.contains('down-btn')) {
            const index = parseInt(e.target.dataset.index);
            if (index < tasks.length - 1) {
                [tasks[index], tasks[index+1]] = [tasks[index+1], tasks[index]];
                saveTasks();
                renderTasks();
            }
        }
    });
    
    // Первоначальная загрузка
    renderTasks();
});