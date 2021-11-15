#!/bin/bash

for i in /mnt/c/Users/scott/Documents/GitHub/sketchy-pwned-passwords/files/*
do
        screen -d -m php increment.php $i
done
