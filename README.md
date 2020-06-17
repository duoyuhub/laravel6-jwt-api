## 项目说明
- [项目参考](https://github.com/guaosi/Laravel_api_init)
- [Telescope 调试工具](https://learnku.com/docs/laravel/6.x/telescope/5193)
- 基于 `laravel 6.*` `jwt` 快速开始 api 开发。
    - 包含多角色验证
    - token 自动刷新
    - 访问频率限制

## 环境

- laravel 6.*
- php 7.2
- mysql 5.5

## 使用

1. **克隆项目**
    - `https://github.com/duoyuhub/laravel6-jwt-api.git`

2. **创建 .env 文件**
    - `cp .env.example .env`

3. **创建应用 secret**
    - `php artisan key:generate`

4. **创建jwt secret**
    - `php artisan jwt:secret`



