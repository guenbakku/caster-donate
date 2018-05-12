# Deploy source code

## Cài đặt

1. Pull source code từ repository về và chuyển sang nhánh `deploy`.

1. Cài đặt các thư viện cần thiết

    ```
    $ cd /path/to/deploy
    $ composer install
    ```

1. Tạo thư mục chứa khóa bí mật và xét quyền thích hợp

    ```
    $ mkdir ~/.ssh/private_keys
    $ chmod 700 ~/.ssh/private_keys
    ```

1. Copy khóa bí mật dùng để kết nối ssh tới server vào thư mục vừa tạo và xét quyền thích hợp

    ```
    $ cp /path/to/toilensong.pem ~/.ssh/private_keys/
    $ chmod 400 ~/.ssh/private_keys/toilensong.pem
    ```

    Khóa bí mật cho từng server có thể tải [tại đây](https://redmine.nvb-online.com/projects/cast-donate/wiki/Th%C3%B4ng_tin_server).
    

## Thực hiện deploy

1. Đi đến thư mục chứa script deploy

    ```
    $ cd /path/to/deploy
    ```

1. Thực hiện một trong các lệnh sau

    ```
    $ vendor/bin/dep deploy {stage hoặc hostname} --branch {branch-name}
    ```

    hoặc

    ```
    $ vendor/bin/dep deploy {stage hoặc hostname} --tag {tag-name}
    ```

    hoặc

    ```
    $ vendor/bin/dep deploy {stage hoặc hostname} --revision {revision-hash}
    ```

    Ví dụ

    ```
    $ vendor/bin/dep deploy test --branch develop
    ```

    Thông tin thêm về Deployer xem [tại đây](https://deployer.org/docs).