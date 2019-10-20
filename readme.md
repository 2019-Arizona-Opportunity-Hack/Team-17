# Zuri's Circle

In CentOS server,
this node project lives in `/var/www` directory.
Includes:
- MySQL
- NodeJS v10.16.3
- npm@6.9.0

```sh
ssh root@zuris-circle.com

/var/lib/mysql/ZurisCircle/
├── category.ibd
├── page.ibd
├── request.ibd
└── user.ibd

npm list --global --depth=0
/usr/lib
├── browserify@16.5.0
├── npm@6.9.0
└── watchify@3.11.1

node -v # v10.16.3
npm -v # 6.9.0
```