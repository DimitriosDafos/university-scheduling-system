# University Room Info System

The **University Room Info System** is a Laravel-based application designed to manage and display university room schedules and event info.

## Features

- **Monitor View**: A dedicated, high-contrast dashboard for room status and daily schedules.
- **Room Management**: Admin interface to manage university rooms and their availability.
- **Event Scheduling**: Comprehensive system for booking and tracking events in specific rooms.
- **Microsoft Integration**: Supports OAuth authentication via Microsoft Socialite.

## Getting Started

### Prerequisites

- PHP 8.3+
- Composer
- Node.js & NPM

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/DimitriosDafos/university-scheduling-system.git
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Configure your environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Run migrations:
   ```bash
   php artisan migrate
   ```

5. Build assets:
   ```bash
   npm run build
   ```

## Usage

- Access the main dashboard at `/dashboard`.
- View the room monitor at `/monitor`.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
