# 📱 ChatApp

## 📝 Description 🗨️

ChatApp is a campus-level communication platform designed to ensure secure and efficient interaction among students, with admin oversight to manage and monitor activities. Only authorized users can sign up for the app. 🏫

---

## 🌟 Features ✨

- **User Authentication:** Secure sign-up and login for authorized users only.
- **Admin Monitoring:** Admin can monitor all activities to ensure appropriate usage.
- **Email Verification:** Users must verify their email during registration for added security.
- **Student Verification:** Only students listed in the `student_info` database table can sign up.
- **Chat Functionality:** Real-time messaging for seamless campus communication.
- **Admin Panel:** Dedicated admin interface for managing users, monitoring chats, and updating settings.
- **Syllabus Management:** Admin can upload syllabus files to `assets\images\syllabus` and update syllabus details in the `syllabus` table.
- **Form Builder:** Admin can create and distribute custom forms to collect data or feedback from users.
- **Responsive Design:** Works across desktop and mobile platforms.
- **Data Security:** Passwords and sensitive information are encrypted.
- **Easy Setup:** Clear configuration files for database and email settings.
- **Customizable:** Modify and expand the app to suit specific needs.

---

## 🎥 Demo 🌐

- **Web:** [ChatApp](http://chatapp.000.pe/)
- **APK:** [ChatApp.apk](https://github.com/rudrarathod/ChatApp/blob/main/ChatApp.apk)
- **Demo User Email:** `testuser@msm.com`
- **Demo User Enrollment ID:** `123456789`
- **Demo User Password:** `testuser`

---

## ⚙️ Requirements 🖥️

- A server environment (e.g., XAMPP) to host the project.
- A MySQL database for storing app data.

---

## 🛠️ Installation Instructions 📂

### 1. Database Setup 📊

1. Create a new MySQL database for the project.
2. Import the `database.sql` file into the created database.

### 2. Email Configuration ✉️

1. Open `assets\php\send_code.php`.
2. Replace the placeholders with your email details:
   - Replace `uremail` with your email ID.
   - Replace `apppassword` with your app password.
3. Follow [this guide](https://knowledge.workspace.google.com/kb/how-to-create-app-passwords-000009237) to generate a new app password.

### 3. Database Configuration 🛠️

1. Navigate to `assets\php\config.php`.
2. Update the following fields with your database credentials:
   ```php
   const DB_NAME = 'your_database_name';
   const DB_HOST = 'your_database_host';
   const DB_USER = 'your_database_username';
   const DB_PASS = 'your_database_password';
   ```
3. Open `admin\form_builder\classes\DBConnection.php`.
4. Update the database connection details as follows:
   ```php
   $host = 'your_database_host';
   $username = 'your_database_username';
   $password = 'your_database_password';
   $database = 'your_database_name';
   ```

### 4. User Data Setup 👩‍🎓👨‍🎓

- Populate the `student_info` table in the database with student details.  
  Only students whose data exists in this table will be able to sign up for the app.

### 5. Admin Panel Access 🔑

1. Access the admin panel by appending `/admin` to your app's URL:  
   Example: `http://chatapp.000.pe/admin`.
2. Use the following default credentials to log in:
   - **Email:** `admin@admin.com`
   - **Password:** `admin`
3. **Important:** Update the admin email and password immediately after logging in to enhance security.

### 6. Syllabus Management 📚

1. Admin can upload syllabus files directly to the `assets\images\syllabus` folder.
   - File formats should follow naming conventions for easy reference (e.g., `course_code_subject.pdf`).
2. Add corresponding details about the syllabus in the `syllabus` table in the database:
   - `course_id`: Unique identifier for the course.
   - `subject`: Name of the subject.
   - `file_path`: Path to the uploaded syllabus file.

### 7. Form Builder 📋

1. Admin can create custom forms to collect feedback, surveys, or data from users.
2. Forms can be managed from the **Admin Panel** and distributed directly to users.

---

## 📌 Notes 📄

- Ensure all configurations are correctly completed before using the app. ✅
- For troubleshooting or additional setup guidance, refer to the documentation or contact support at [rudrarathod738@gmail.com](mailto:rudrarathod738@gmail.com). 📞
