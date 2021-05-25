"use strict"

const jst = require("jsonwebtoken")

const SECRET_KEY = "keepsThisPasswordSecret"

const user = {
	id: 1,
	username: "mike12",
	password: "holitas",
	sessionId: "433f74105"
}

console.log("Sing Token")

const token = jwt.sign({
	username: user.username,
	sessionId: user.sessionId

}, SECRET_KEY)