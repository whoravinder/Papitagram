<h1 align="center">📷 Papitagram</h1>
<p align="center">
  <b>A lightweight PHP + MySQL app for posting images (“reels”), likes, comments, follows, basic profiles, and 1–1 chat. Built as a single-PHP-file style project—easy to run locally or drop onto shared hosting.</b><br>
  <sub>Created by Ravinder Singh • Licensed under Authors license</sub>
</p>

<p align="center">
  <a href="https://www.python.org/downloads/"><img src="https://img.shields.io/badge/Python-3.8+-3776AB.svg?logo=python&logoColor=white"></a>
  <a href="LICENSE"><img src="https://img.shields.io/badge/License-AGPL--3.0-orange.svg"></a>
  <a href="#"><img src="https://img.shields.io/badge/Platform-Windows%20%7C%20macOS%20%7C%20Linux-blue.svg"></a>
</p>

---

## Table of Contents
- [Features](#-features)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Screenshots](#-screenshots)
- [License](#-license)
- [Contributing](#-Contributing)

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

## 📸 Working Prototype

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
git clone https://github.com/whoravinder/addtopdf
cd addtopdf
```
**2. Installing Requirements** :
```bash
pip install requirements.txt
```
**3. Installing Requirements** :
Open Command Prompt(win+r->cmd) and navigate to directory containing `main.py` file and then type in following command 
```bash
python main.py
```
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
   git clone https://github.com/<your-username>/addtopdf
   cd addtopdf
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
- Respect the project scope: New features should align with the purpose of **Add to PDF**.  

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
Have an idea to improve **Add to PDF**?  
- Open a new issue labeled `enhancement`  
- Clearly explain the feature and why it’s beneficial  
- If possible, outline how you might implement it  

---

Thanks for helping 




