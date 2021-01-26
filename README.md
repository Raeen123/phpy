![icon](favicon.ico)

**phpy is library for php**

You can use python in php with it

[![Latest Stable Version](https://poser.pugx.org/raeen/phpy/v)](//packagist.org/packages/raeen/phpy) [![Total Downloads](https://poser.pugx.org/raeen/phpy/downloads)](//packagist.org/packages/raeen/phpy) [![Latest Unstable Version](https://poser.pugx.org/raeen/phpy/v/unstable)](//packagist.org/packages/raeen/phpy) [![License](https://poser.pugx.org/raeen/phpy/license)](//packagist.org/packages/raeen/phpy)[![Monthly Downloads](https://poser.pugx.org/raeen/phpy/d/monthly)](//packagist.org/packages/raeen/phpy)  [![Daily Downloads](https://poser.pugx.org/raeen/phpy/d/daily)](//packagist.org/packages/raeen/phpy)

***
## Features
- Show all output from python file
- Show last line output from python
- Send data to python file
- Get data from python file
- show image in php from python
- path Genrate
- write python line code
- mange python line code
- write python part
- require python part
***

**Install**
```batch
git clone https://github.com/Raeen123/phpy
```
```batch
composer require raeen/phpy
```

***

**Prerequisites**

This is mine config:
```
php = 8.0.1 (Your php version must be at least 7.4 )
python = 3.9.1
numpy = 1.19.3
python-opencv =  4.4.0.46
```

***

**Python**

You must if you don't add  python in your path environment , add yor python path in ``` core/Python.php ``` in ``` const python_path  ```

We use these libraries for create phpy.py:

```python
import sys
import json
import base64
import numpy as np
import cv2
```

Import phpy.py file in Python/include/library/php.py 

***
**Get Data from php**

Get datas to python file
For Get data you must 

```python
phpy.get_data( Number Of Send data )
```


For return data you must use print function
***

**Push data from python**
```python
phpy.push_data(data)
```
It's just 
```python
json.dumps(data)
```
***
**Push image from python**

It function for pushing data from python to php

Example for reading image
```python
cv2.imread()
```
```python
videoCaptureObject = cv2.VideoCapture(0)
ret, frame = videoCaptureObject.read()
```

Pushing image
```python
phpy.push_image(img,type)
```
***
**Send data from php**

Create and Send data from php to python 

You can send infinite data

```php
require_once "../vendor/autoload.php";

use app\core\App;

$app = new App();
$python = $app->python;

$data1 = [
    'name' => 'raeen',
    'library' => 'phpy'
];
$data2 = "test";
$output = $python->set("../Python/test2.py")->send($data1, $data2)->gen();
```
live output example:


```php
$site = "google.com";
$python->set('../Python/test6.py')->send($data)->live()->gen();
```
***
**Show result**

```php
$output = $python->set(path)->send(datas..)->gen()
```


***
**Show Img**

You can use this function to genrate what's return from phpy.push_img()
```php
$app->img($output,$type,$show,$style)
```
**$type must be same type in php.push_img()**

If $show is true , show image in img tag

Also you can set style for this

Example
```php
$app->img($output,$type,true,
[
    'border' => '1px solid red'
])
```
***
**Path**

For example , I have image file in this diractory but python file in Python/**.py and I want to send path to it . for this in must to send this path ../my-img Or use this functiuon for send path file or directory

```php
$app->path(__Dir__,path)
```

***
**Ini**

If you have loop in php file it's very good to add this function in top of file

```php
$app->ini()
```
***

**Snippet**

**One Line**

If you want to run a python line , you should use this function

```php
$Snippet->set($code,function(){ 
    // controller 
})->gen();
```

For control varable , you should it's name in ``` |&name| ```

For fill varable you should ```return array``` , it must be in order

You must use ```"``` in python code and use ```;``` in the end of each line
```php
$Snippet = $app->snippet;
$Snippet->set("print(f'hello world {|&data|*7*|&test|}'); print('--Hello')",
function ($data,$test) {
    $data = 2;
    $test = 9;
    $data2 = $data*5;
    return [$data2 , $test];
})->gen();

```
**Lines**

**start**
Before start writing codes you should use this

```php
$Snippet->start(name);
```

For write your codes , you should use this

```php

$Snippet->line(code)
.
.
.

```

For end of lines

```php
$Snippet->end(name,save_last)
```

*name in start function must be same this name*

For get output anywhere you should use this

```php
$Snippet->select(name)->gen()
```


**Example , index.php :**

```php
$Snippet->start("test");
$Snippet->line("a = 'Hello world'");
$Snippet->line("print(a)");
$Snippet->end("test");
$Snippet->select("test")->gen();
```

```output
Output : Hello world 
```

**You can use this code in another file**

```php

$Snippet->select("test")->gen();

```

```output
Output : Hello world 
```
***

**Live Output**
Any where (Snippet and Python class) you can use this so easy

just before use ```gen()``` use ```live()``` then use ```gen(/* you can write function here to control output */)
```php
$python->set("../Python/test6.py")->send($site)->live()->gen(
    function ($res) {
        return "<pre>$res</pre>";
    }
);
```
you can also set time without each reading ouput (defult is 1)
```php
$python->set("../Python/test6.py")->send($site)->live()->ini(3)->gen(
    function ($res) {
        return "<pre>$res</pre>";
    }
);
```
```php
$Snippet->set(
    "import subprocess as sub; sub.call('ping |&site|') ",function($site){ $site = "google.com"; return [$site];}
)->live()->ini(3)->gen();

```

```php
$Snippet->select('snippet-test8')->live()->gen(function($res){ return "<b><pre>$res</pre></b>";});
```
**License**

MIT License

Copyright (c) 2021 Raeen Ahani Azari

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
***

**Example**

There are examples in php and python diractory
***
**BY RAEEN AHANI AZARI**
