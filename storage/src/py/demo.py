def add(a, b):
	c = int(a)+int(b)
	print(c, end='')

if __name__ == '__main__':
   import sys
   (add(sys.argv[1], sys.argv[2]))
