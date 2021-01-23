import include.library.phpy as phpy
import numpy as np
import cv2

videoCaptureObject = cv2.VideoCapture(0)
ret, frame = videoCaptureObject.read()
phpy.push_img(frame,'jpg')
if(cv2.waitKey(1) & 0xFF == ord('q')):
    videoCaptureObject.release()
    cv2.destroyAllWindows()
