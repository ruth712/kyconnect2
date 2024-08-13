Sfunction redirectToRolePage() {
    // Get the selected value from the dropdown
    const selectedRole = document.getElementById('acc-type-select').value;

    // Define the URLs for each role
    let url = '';
    switch(selectedRole) {
        case 'houseparent':
            url = 'https://ruth712.github.io/kyconnect2/KYConnect%20-%20Copy/Registration%20Pages/houseparent_register.html';
            break;
        case 'teacher':
            url = 'https://ruth712.github.io/kyconnect2/KYConnect%20-%20Copy/Registration%20Pages/teacher_register.html';
            break;
        case 'guard':
            url = 'https://ruth712.github.io/kyconnect2/KYConnect%20-%20Copy/Registration%20Pages/guard_register.html';
            break;
        case 'student':
            url = 'https://ruth712.github.io/kyconnect2/KYConnect%20-%20Copy/Student%20Interface/student_register.html';
            break;
        case 'parent':
            url = 'parent_page.html';
            break;
        default:
            url = 'default_page.html'; // Fallback URL
    }

    // Redirect to the corresponding page
    window.open(url);
}