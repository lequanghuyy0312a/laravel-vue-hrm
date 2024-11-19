import {TOKEN}from './constant/index.js'

export function getToken(){
	return localStorage.getItem(TOKEN)
}