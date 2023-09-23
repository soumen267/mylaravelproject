# ecommercestore

Steps to follow:

1. git clone https://github.com/soumen267/mylaravelproject.git
2. composer update
3. copy .env.example and rename it .env
4. php artisan key:generate
5. npm install & npm run dev
6. add the below SMTP in the env file

  DROPDOWN_API_KEY = "dyESWqLiXDGH5oNRHyvoop9NaiGi-K5-4fYi1ChwH_tVwmdPU6pHG5aOZwpa6tGo9Zg"
  COUNTRY_API = "QzZMZkVIYWdSQlJzVldKbTJCa041NnNQWVhMaVk2ckFUTEl2RUt4Yg=="
  STRIPE_KEY=pk_test_51ILUVRGw7RRRZzo7CWtC8xxQflqorMK1edWiodf052lpdzGKQKalt4dzi7BxvX513rvAjWxTL7QnSXhdaH4uPksx00RWUvLi7a
  STRIPE_SECRET=sk_test_51ILUVRGw7RRRZzo7oYymWXHhPQyWizI06Qv4eORagRreZTXh2zNGXBA2AqdO2qsiWJrCoEhXtxi0rH1ympZxPRwo00C20N23wM

7. change dbname to DB_DATABASE=ecommercedb
8. Create db ecommercedb
9. php artisan migrate:refresh --seed
10. User credentials:
    1. email: user1@gmail.com / pwd: user1
    2. email: user2@gmail.com / pwd: user2
11. Admin credentials:
    1. email: admin1@email.com / pwd: password
