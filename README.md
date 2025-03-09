# PHP Cloud Storage SaaS

## About the Project
This project is a **cloud storage SaaS system** developed in PHP. Users can upload, manage their files, and utilize storage space based on their membership level. Files are **compressed in ZIP format**, and the **compression ratio increases based on file access duration**.

🚀 **Note:** This is a **hobby project** and is not a fully comprehensive solution. The file compression methods used are **basic and not fully optimized** for efficiency. The implementation provides a **fundamental approach to compression**, and better techniques could be explored in the future.

## Key Features
- **User Authentication & Authorization** (Email-based sign-up and login, OAuth in future updates)
- **Membership Plans and Storage Limits**
- **File Upload and Management:**
  - Upload, delete, rename files
  - Drag & Drop support
  - Upload & Download
- **File Encryption** (Enabled by default)
- **File Access Control:**
  - Public files
  - Private files
  - Semi-public files (Password-protected access)
- **ZIP Compression** (Increasing compression ratio based on access duration, future updates may introduce other compression methods)
- **Plain HTML, Bootstrap, and jQuery for Frontend**
  - Single theme option: **Dark Theme** (Light Theme will be added in future versions)
- **SaaS Model** (Designed as a user-focused service)

## Technologies Used
- **Backend:** PHP 8.4.0 (Compliance information will be filled in)
- **Frontend:** HTML, CSS, JavaScript (jQuery, Bootstrap)
- **Database:** MySQL
- **Storage:** Local file system (Cloud integration may be considered in the future)
- **Compression:** PHP `ZipArchive`