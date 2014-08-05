#!/usr/bin/python3
import re
from subprocess import Popen, PIPE
import cgi
import cgitb; cgitb.enable()

morph_file = 'fr.morph.bin'
gen_file = 'fr.gen.bin'
input_word = cgi.FieldStorage().getvalue("word")

p = Popen(['lt-proc', morph_file], stdin=PIPE, stdout=PIPE, universal_newlines=True)
lex = p.communicate(input = input_word+"\n")[0].strip()
lex = re.sub("^\\^[^/]+/", "^", lex)

lex = lex.replace("<sg>", "<pl>")
p = Popen(['lt-proc', '-g', gen_file], stdin=PIPE, stdout=PIPE, universal_newlines=True)
plural = p.communicate(lex+"\n")[0].strip()

lex = lex.replace("<pl>", "<sg>")
p = Popen(['lt-proc', '-g', gen_file], stdin=PIPE, stdout=PIPE, universal_newlines=True)
singular = p.communicate(lex+"\n")[0].strip()

print("Content-type: application/json")
print("")
print("{\"singular\":\"%s\", \"plural\":\"%s\"}"%(singular, plural))
