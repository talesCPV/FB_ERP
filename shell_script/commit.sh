#!/bin/bash
# Upload files to Github - https://github.com/talesCPV/FB_ERP.git

  git config --global user.email "tales@flexibus.com.br"
  git config --global user.name "talesCPV"


cd ..

git init

git add .

git commit -m "by_script"

git remote add origin "https://github.com/talesCPV/FB_ERP.git"

git commit -m "by_script"

git push -f origin master


