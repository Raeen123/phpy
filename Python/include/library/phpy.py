import sys
import json
import base64
import numpy as np
import cv2


def get_data(index_args):
    json_php_get = sys.argv[index_args]
    php_get = json_php_get.replace(" ", '"')
    try:
        jsons = json.loads(php_get)
        return jsons
    except:
        print('error from get data')


def push_data(data):
    print(json.dumps(data))


def push_img(img, type):
    type_res = "."+type
    _, im_arr = cv2.imencode(type_res, img)
    im_bytes = im_arr.tobytes()
    im_b64 = base64.b64encode(im_bytes)
    return(im_b64)
