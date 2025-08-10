<h1 align="center">📷 Papitagram</h1>
<p align="center">
  <b>A lightweight PHP + MySQL app for posting images,reels, likes, comments, follows, basic profiles, and 1–1 chat. Built as a single-PHP-file style project—easy to run locally or drop onto shared hosting.</b><br>
  <sub>Created by Ravinder Singh(ravindercjsingh@gmail.com) • Licensed under Authors license</sub>
</p>

<p align="center">
  <a href="https://www.php.net/downloads.php"><img src="https://img.shields.io/badge/PHP-8%2B-777BB4.svg?logo=php&logoColor=white"></a>
  <a href="https://dev.mysql.com/"><img src="https://img.shields.io/badge/MySQL-5.7%2B-4479A1.svg?logo=mysql&logoColor=white"></a>
  <a href="LICENSE"><img src="https://img.shields.io/badge/License-AGPL--3.0-orange.svg"></a>
  <a href="#"><img src="https://img.shields.io/badge/Platform-Apache%20%7C%20Nginx%20%7C%20PHP%20Built--in-2ea44f.svg"></a>
</p>


---

## Table of Contents
- [Features](#features)
- [Working Prototype](#-working-prototype)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [License](#license)
- [Contributing](#contributing)

---

## Features
- User auth: register, login, logout
- Profiles: avatar upload/update
- Posts/Reels: image/video upload with captions
- Likes & comments (AJAX endpoints for smooth UX)
- Follow/unfollow & simple feed on `index.php`
- Chat: minimal direct messaging (`chat.php`, `chat_list.php`)
- Clean header/navbar partials
- Small, readable PHP files—great for learning or quick demos

---

## Working Prototype

-Please visit <a href="https://lostdevs.io/papitagram"> this link for the prototype </a>

---

## Tech Stack

- PHP 8+ (works on 7.4+, but 8.x recommended)
- MySQL
- HTML5, CSS (vanilla), a pinch of JS (fetch/XHR)
- Apache/Nginx or PHP built-in server / XAMPP
- You may use shared hosting for deployment or `XAMPP` for deploying on your local machine

---

## Installation

**1. Clone or download** this repository:
```bash
git clone https://github.com/whoravinder/papitagram
```
**2. Required Tables** :

The application uses the following six tables:

```sql
-- 1. Users table
CREATE TABLE users (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  avatar_url VARCHAR(255) DEFAULT 'uploads/avatars/default.png',
  bio TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Posts table
CREATE TABLE posts (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  user_id INT(11) NOT NULL,
  media_url VARCHAR(255) NOT NULL,
  media_type ENUM('image', 'video') NOT NULL,
  caption TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Likes table
CREATE TABLE likes (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  user_id INT(11) NOT NULL,
  post_id INT(11) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
  UNIQUE KEY uniq_like (user_id, post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Comments table
CREATE TABLE comments (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  user_id INT(11) NOT NULL,
  post_id INT(11) NOT NULL,
  comment_text TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Follows table
CREATE TABLE follows (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  follower_id INT(11) NOT NULL,
  following_id INT(11) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (follower_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (following_id) REFERENCES users(id) ON DELETE CASCADE,
  UNIQUE KEY uniq_follow (follower_id, following_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Messages table
CREATE TABLE messages (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  sender_id INT(11) NOT NULL,
  receiver_id INT(11) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

**3. Editing Config.php file** :
Look for config.php file it will have following variables
```php
<?php
$host = "localhost";
$user = "";
$pass = "";  
$db = "";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```
<p>Put in the details accordingly, if you are using XAMPP use phpmyadmin based details and if you are deploying on shared hosting you can get these details from your hosting provider. Better create a new database for this application</p>

**4. Start your php server**
If you are on local machine you can use built in php server (Command: `php -S localhost:8000`) but it would be better to use XAMPP, rest if you are uploading it too shared hosting you can directly upload the folder in `public_html` and everything will be working.

---
## License
This project is licensed under the GNU Affero General Public License v3.0 (AGPL-3.0-only).

You are free to use, modify, and distribute this software — even commercially —
as long as you publish your source code (including modifications) under the
same license. This requirement applies whether you distribute binaries or make
the software available over a network.

See the [LICENSE](LICENSE) file for full details.

---
## Contributing

I ❤️ contributions! Whether it's fixing bugs, improving documentation, or adding new features, your help is welcome.

### How to Contribute

1. **Fork** the repository  
   Click the **Fork** button at the top-right of this page to create your own copy of this repo.  

2. **Clone your fork**  
   ```bash
   git clone https://github.com/whoravinder/papitagram
   
   ```  

3. **Create a new branch**  
   ```bash
   git checkout -b feature/your-feature-name
   ```  

4. **Make your changes**  
   - Keep code style consistent with the existing codebase.  
   - Add comments where necessary.  
   - Update the README if you change functionality or add features.  

5. **Commit your changes**  
   ```bash
   git add .
   git commit -m "Add: Short description of your changes"
   ```  

6. **Push to your branch**  
   ```bash
   git push origin feature/your-feature-name
   ```  

7. **Open a Pull Request**  
   - Go to your fork on GitHub  
   - Click **Compare & pull request**  
   - Describe your changes and link any relevant issues  

---

### Contribution Guidelines
- **Follow the license**: By contributing, you agree that your contributions will be licensed under the same license as this project (**AGPL-3.0-only**).  
- Keep PRs focused: One feature or fix per pull request.  
- Use clear commit messages: `Add:`, `Fix:`, `Update:`, `Docs:` prefixes are encouraged.  
- Respect the project scope: New features should align with the purpose of **Papitagram**.  

---

### Reporting Issues
If you find a bug:  
- Check the [Issues](../../issues) page to see if it’s already reported.  
- If not, open a new issue with:  
  - Steps to reproduce  
  - Expected behavior  
  - Actual behavior  
  - Screenshots (if applicable)  
  - Your OS, Python version, and conversion backend (MS Office / LibreOffice)  

---

### Feature Requests
Have an idea to improve **Papitagram**?  
- Open a new issue labeled `enhancement`  
- Clearly explain the feature and why it’s beneficial  
- If possible, outline how you might implement it  

---

Thanks for helping 




