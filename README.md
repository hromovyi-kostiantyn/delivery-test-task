# Delivery Fee Test task

Laravel simple application that calculating fee for delivery using a strategy pattern

## Stack

- PHP 8.4
- Laravel 12
- Docker (Sail)

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd delivery-test-task
```

2. Install dependencies:
```bash
composer install
```

3. Copy the environment file:
```bash
cp .env.example .env
```

4. Start the app:
```bash
sail up -d
```

5. Generate application key:
```bash
sail artisan key:generate
```

## API example

**Endpoint:** `POST /api/calculate-delivery-fee`

**Request Body:**
```json
{
  "destination": "kyiv",
  "weight": 3.5,
  "delivery_type": "express"
}
```

**Response:**
```json
{
  "fee": 135
}
```

## Testing

Run the tests
```bash
sail artisan test
```
### Test Results

✅ Set delivery strategy  
✅ Calculate fee with standard delivery no extra weight  
✅ Calculate fee with extra weight  
✅ Calculate fee with express delivery  
✅ Calculate fee with kyiv discount  
✅ Standard delivery calculates fee  

