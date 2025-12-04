const list = document.getElementById('student-list');
const input = document.getElementById('student-name');

document.getElementById('student-form').addEventListener('submit', (e) => {
    e.preventDefault(); // Prevent page reload
    if (!input.value.trim()) return alert('Please enter a student name');

    const li = document.createElement('li');
    li.className = 'student-item';

    const span = document.createElement('span');
    span.textContent = input.value;

    const createBtn = (text, className, action) => {
        const btn = document.createElement('button');
        btn.textContent = text;
        btn.className = className;
        btn.onclick = action;
        return btn;
    };

    li.append(span,
        createBtn('Edit', 'btn-edit', () => {
            const newName = prompt('Enter new name:', span.textContent);
            if (newName) span.textContent = newName;
        }),
        createBtn('Delete', 'btn-delete', () => li.remove())
    );

    list.appendChild(li);
    input.value = '';
});

const toggleBtn = document.createElement('button');
toggleBtn.textContent = 'Highlight Students';
toggleBtn.onclick = () => document.querySelectorAll('.student-item').forEach(li => li.classList.toggle('highlight'));
document.body.appendChild(toggleBtn);