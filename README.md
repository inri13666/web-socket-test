##### Installation

````bash
composer install
````

##### Usage

```bash
php bin/console akuma:web-sockets:test --host=ws://echo.websocket.org -l 667
```

##### Example output

```log
Message from "ws://echo.websocket.org" received "Hello Echo ASR from Client 703"
Message from "ws://echo.websocket.org" received "Hello Echo ASR from Client 704"
Message from "ws://echo.websocket.org" received "Hello Echo ASR from Client 705"
Message from "ws://echo.websocket.org" received "Hello Echo ASR from Client 706"
Message from "ws://echo.websocket.org" received "Hello Echo ASR from Client 707"
Message from "ws://echo.websocket.org" received "Hello Echo ASR from Client 708"
Error accured "Connection to 'ws://127.0.0.1/echo' failed: Server sent invalid upgrade response:
HTTP/1.1 500 Internal Server Error
Server: nginx/1.12.2
Date: Wed, 17 Apr 2019 16:51:43 GMT
Content-Type: text/html
Content-Length: 85330
Connection: close
ETag: "5c8e7a0b-14d52""
```
