Reph
====

Requirements
============
1. You need the [Pharen language](http://pharen.org) installed.
2. A simple TCP client, netcat on Linux (`nc`) works great

Usage
=====
Compile Reph with:
```bash
$ pharen reph.phn
```

Start the server:
```bash
$ php reph.php
Initializing Reph server on 127.0.0.1:10000
```
Note that this uses **.php**

Connect to the server with your client and hack away!
```bash
$ nc localhost 10000
Initialized Pharen REPL. (map) new worlds!
pharen> (map (* 2) [1 2 3])
[2, 4, 6]
pharen>
```
