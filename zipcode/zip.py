#!/usr/local/python/bin/python3
# coding:utf-8
import os
import zipfile
import sys

file = sys.argv[1]
compression = zipfile.ZIP_DEFLATED
# absPath = os.path.join(os.getcwd(), file)
absPath = os.path.abspath(file)
print(absPath)
modes = {zipfile.ZIP_DEFLATED: 'deflated', zipfile.ZIP_STORED: 'stored'}
# 压缩文件
if os.path.isfile(absPath):
    print("file")
    zf = zipfile.ZipFile(file + '.zip', mode='w')
    try:
        zf.write(file, compress_type=compression)
    finally:
        zf.close()
else:
    # 压缩文件夹
    zf = zipfile.ZipFile(absPath + ".zip", mode="w")
    filelist = []
    for root, dirs, files in os.walk(absPath):
        for name in files:
            filelist.append(os.path.join(root, name))
    # 没有空文件夹
    for tar in filelist:
        # 取出相对路径
        arcname = tar[len(absPath):]
        zf.write(tar, arcname=arcname, compress_type=compression)
    # zf.write(filelist, compress_type=compression)
    zf.close()
