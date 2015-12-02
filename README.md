![Larashop](https://raw.githubusercontent.com/rustem-art/larashop/master/gitimgs/logo.png "LaraShop") 
# LaraShop
LaraShop is a simple SHOP CMS based on Laravel framework.
Temporarily available at russian language, in planned english.

<h4>Screenshots</h4>
![Image](https://raw.githubusercontent.com/rustem-art/larashop/master/gitimgs/dashboard.png)
![Image](https://raw.githubusercontent.com/rustem-art/larashop/master/gitimgs/order.png)
![Image](https://raw.githubusercontent.com/rustem-art/larashop/master/gitimgs/product.png)
![Image](https://raw.githubusercontent.com/rustem-art/larashop/master/gitimgs/productPage.png)
![Image](https://raw.githubusercontent.com/rustem-art/larashop/master/gitimgs/purchase.png)
![Image](https://raw.githubusercontent.com/rustem-art/larashop/master/gitimgs/cart.png)


<h4>Features</h4>
- Shopping cart
- Gallery page
- Catalogs & Products and their orders
- Product comments
- Purchase form (ajax)
- Admin dashboard
- Mailing
- Orders statuses and mailing
- SEO nice URLs & AUTO-SITEMAP http://[url]/sitemap.xml


<h4>Installation</h4>
```bash
sudo php artisan migrate:install
sudo php artisan migrate
sudo php artisan db:seed --class=UsersTableSeeder
```

Rename .env.example to .env
Go to http://[sitename]/admin

|  Auth login   |     value     |
| ------------- |:-------------:|
| login         | admin@local   |
| pass          | 123456        |

After logIn, you can change mail & pass.

<h4>Get delivery cities & units</h4>
For SYNC delivery cities & units, try:

1. Change API nova poshta in settings (web-admin)
2. Try command
```bash
sudo php artisan np:sync
```

For working mail queue, try next commands:

```
sudo apt-get install supervisor
sudo nano /etc/supervisor/conf.d/laravel-worker.conf
```

Edit file and save:
```
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /home/forge/app.com/artisan queue:work --sleep=3 --tries=3 --daemon
autostart=true
autorestart=true
user=forge
numprocs=8
```

```
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
```

<h4>Notes</h4>
This CMS has been written for 2 weeks for training and knowledge in fine php framework Laravel.
Thanks Taylor Otwell!

<h4>Working projects</h4>
- [Buben.Biz.UA](http://buben.biz.ua)
- [IT-toys](http://it-toys.com)

<h4>Links</h4>
- [LaraCasts](http://laracasts.com)
- [LaravelDocs](http://laravel.com/docs/5.1/)
- [AdminLTE theme](https://almsaeedstudio.com/themes/AdminLTE/index2.html)
