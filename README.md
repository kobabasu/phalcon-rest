# phalcon-rest

## vagrant
1. hub clone cores/cores-vagrant coreos
1. cd coreos
1. mv user-data.sample user-data
1. mv config.rb.sample config.rb
1. vim Vagrantfile
1. * $instance_name_prefix = "任意の名前"
1. * NFCの設定
1. * config.vm.network 80->8080, 443->3443, 3306->3306
1. vagrant up
1. vagnrat ssh

## docker
1. mysql
```
docker run --net=host --name mysql -p 3306:3306 -e "ROOT_PW=..." -e "DB_NAME=..." -e "DB_USER=..." -e "DB_PASS=..." -d anagift/mysql:0.74
```
1. apache
```
docker run --net=host --name -p 80:80 -p 443:443 -v /home/core/share/app:/var/www/html -d kobabasu/apache:0.21
```
1. exit

## app
1. cd app
1. hub clone kobabasu/phalcon-rest api
1. rm -fr api/.git
1. touch package.json
1. package.jsonを参考にfrisbyを追加
1. (npm install -g jasmine-node)が必要
1. npm install

## mysql
1. table作成
```
mysql -h 0.0.0.0 --port 3306 -u[username] -p[password] -d [dbname] < sql api/sql/user.sql
```
1. http://localhost:8080/api/users/で確認

## REST API
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

## frisbyでテスト
1. api/spec/src/users_spec.es6のIDを確認・変更
1. babel --out-dir api/spec/ api/spec/src
1. jasmine-node api/spec
1. すべてテストをパスすればOK
