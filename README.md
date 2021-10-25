# php-crud-static

## Mengunduh Repository

Unduh repository ke dalam komputer menggunakan perintah `git clone`. Url
repository dapat dilihat di dalam repository yang diinginkan.


```
URL REPOSITORY
https://github.com/yuansheva/php-login-register.git
```

```
git clone <url repository> 
```

#### Contoh

```
user@host:~$ git clone https://github.com/yuansheva/php-login-register.git
Cloning into 'main'...
remote: Counting objects: 4, done.
remote: Compressing objects: 100% (4/4), done.
remote: Total 4 (delta 0), reused 4 (delta 0), pack-reused 0
Unpacking objects: 100% (4/4), done.
```
## Memperbarui Repository

Perbarui repository yang telah diunduh ke dalam komputer menggunakan perintah `git pull`

```
git pull origin <nama branch>

```

#### contoh 

```
git pull https://github.com/yuansheva/php-login-register.git
From https://github.com/yuansheva/php-login-register
 * branch            master     -> FETCH_HEAD
Already up-to-date.

```

## Setting koneksi database 

```
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'php-crud';
```
