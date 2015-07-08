# phalcon-rest

`hub clone kobabasu/phalcon-rest api`

## npm
1. 必要があればdevelopブランチを使う  
   `git checkout develop`
1. package.json.sampleを確認。流用する場合はリネーム  
   `mv package.json.sample package.json`
1. `npm install`
1. `npm run build`

## vagrant
1. `hub clone cores/cores-vagrant coreos`
1. `cd coreos`
1. 必要なファイルをリネーム  
   * `mv user-data.sample user-data`
   * `mv config.rb.sample config.rb`
1. Vagrantfile編集  
   `vim Vagrantfile`
   * `$instance_name_prefix = "任意の名前"`
   * NFSの設定
   * portの設定 80->8080, 443->3443, 3306->3306
1. `vagrant up`

## docker
1. `vagnrat ssh`
1. mysqlコンテナ起動
```
docker run --net=host --name mysql -p 3306:3306 -e "ROOT_PW=..." -e "DB_NAME=..." -e "DB_USER=..." -e "DB_PASS=..." -d anagift/mysql:0.74
```
1. apacheコンテナ起動
```
docker run --net=host --name -p 80:80 -p 443:443 -v /home/core/share/app:/var/www/html -d kobabasu/apache:0.21
```
1. `exit`

## mysql
1. table作成
```
mysql -h 0.0.0.0 --port 3306 -u[username] -p[password] -d [dbname] < sql api/sql/user.sql
```
1. レコードをinsert
```
curl -i -X POST -d '{"name":"taro", "email":"taro@example.com"}' http://localhost:8080/api/users/
```
1. http://localhost:8080/api/users/で確認

## frisby
1. DBに存在するIDを確認しコード変更
   `vim api/spec/src/users_spec.es6`
1. `npm test`
1. すべてテストをパスすればOK

## REST sample
1. INDEXを表示
```
curl -i -X GET http://localhost:8080/api/users/
```
1. レコードを表示
```
curl -i -X GET http://localhost:8080/api/users/{存在するレコード}
```
1. レコードをinsert
```
curl -i -X POST -d '{"name":"taro", "email":"taro@example.com"}' http://localhost:8080/api/users/
```
1. レコードを変更
```
curl -i -X PUT -d '{name":"curl", "email":"curl@example.com"}' http://localhost:8080/api/user/{存在するレコード}
``` 
1. レコードを削除
```
curl -i -X DELETE http://localhost:8080/api/users/14
```
