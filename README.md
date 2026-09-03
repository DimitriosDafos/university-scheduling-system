# University Scheduling System

> A free, open-source room and schedule management system built with Laravel 12. Ready to deploy for universities, schools, co-working spaces, conference centers, and corporate offices.

**🆓 Free to use — Support available on request.**

---

## Live Demo

**URL:** [webapps.dafos.eu/scheduling](https://webapps.dafos.eu/scheduling)

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@example.com` | `ScheduleAdmin2026!` |
| Staff | `staff@example.com` | `ScheduleStaff2026!` |

---

## Features

### For Users (Staff)
- **Event Management** — Create, edit, delete scheduled events
- **Room Browser** — View available rooms with capacity and features
- **Sort & Filter** — Events sortable by date, room, or lecturer
- **Monitor View** — Full-screen daily schedule display for hallway screens
- **Microsoft SSO** — Azure AD / Microsoft 365 login integration
- **Multi-Language** — English and German included

### For Administrators
- **Room Management** — Add rooms with name, location, capacity, and features
- **Category Management** — Color-coded event categories
- **Lecturer Management** — Manage staff/lecturer accounts
- **Admin Dashboard** — Overview of all resources
- **REST API** — Programmatic access to schedule data

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 12 / PHP 8.4 |
| Database | MySQL / MariaDB |
| Frontend | Blade + Alpine.js + Tailwind CSS |
| Auth | Laravel Breeze + Microsoft SSO (Socialite) |
| API | Laravel REST API |

---

## Getting Started

```bash
git clone https://github.com/DimitriosDafos/university-scheduling-system.git
cd university-scheduling-system

composer install
npm install && npm run build

cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

### Environment Configuration

```env
APP_URL=https://yourdomain.com
DB_DATABASE=your_database
DB_USERNAME=your_user
DB_PASSWORD=your_password

# Optional: Microsoft SSO
MICROSOFT_CLIENT_ID=your_client_id
MICROSOFT_CLIENT_SECRET=your_client_secret
MICROSOFT_REDIRECT_URI=https://yourdomain.com/auth/microsoft/callback
```

---

## White-Label & Branding

The system is designed to be fully rebranded:
- Replace the logo in `public/images/`
- Update the app name in `.env` → `APP_NAME`
- Adjust colors via Tailwind config
- Add your own language files under `lang/`

No code changes needed for basic branding.

---

## Use Cases

- 🎓 **Universities & Schools** — Lecture hall and classroom scheduling
- 🏢 **Corporate Offices** — Meeting room booking and team calendars
- 🏨 **Conference Centers** — Event space management
- 💼 **Co-Working Spaces** — Hot desk and room reservations

---

## License

**MIT License** — Free to use, modify, and distribute.

---

## Support

This project is free and open-source. If you need help with:
- Installation & deployment
- Custom branding & white-labeling
- Feature development
- Integration with your existing systems

📧 **Contact:** developer@dafos.eu

Implementation support is available at an hourly rate. Get in touch to discuss your requirements.
