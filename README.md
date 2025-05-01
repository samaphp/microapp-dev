# 🛠️ MicroApp Dev Tools

**MicroApp Dev** is a CLI companion package for [MicroApp](https://github.com/samaphp/microapp) — a minimal PHP microframework for building super-microservices and tiny APIs.

This package provides CLI tools to quickly scaffold and initialize MicroApp projects, without bloated dependencies or boilerplate.

---

## ✨ Features

- ✅ One-command project setup with `init`
- ✅ Autoload + .htaccess scaffolding
- ✅ `index.php` bootstrapping
- ✅ PSR-4 controller generator with optional route override
- ✅ Route listing tool with controller name display

---

## 🚀 Installation

```bash
composer require --dev samaphp/microapp-dev
```

## ⚙️ What `init` Does

Running the `init` command will:

- ✅ Inject `App\\ => src/` into `composer.json` if missing
- ✅ Copy `.htaccess` to your root directory `.htaccess` if not already present
- ✅ Run `composer dump-autoload` to finalize setup

## 🛣️ Roadmap

Planned CLI tools and enhancements:

- 🔸 **Hookable Error Renderer** to allow custom error output (e.g., HTML or plain text)
- 🔸 **Scaffold lightweight authentication** that provides a simple mechanism to run before route dispatch and validate headers (e.g., tokens or basic auth credentials). Ideal for securing microservices or internal tools without requiring a full authentication system.
- 🔸 **Unified CLI Interface** to simplify all commands under a single entry point (e.g., `vendor/bin/microapp make:controller HomeController`)
- 🔸 **Built-in Dev Server** (`vendor/bin/microapp serve`) using PHP’s internal server with colored output

## 🚧 Disclaimer

This package is intended for development use only and should be installed with `--dev`.  
It provides scaffolding and CLI tooling to speed up project setup, but is not required for production environments.
