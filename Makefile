VERSION = $(shell grep 'Version:' readme.txt | sed 's/Version:[ \t]*//')

build:
	mkdir css-columns/
	cp readme.txt css-columns.php css-columns/
	zip -r "css-columns-${VERSION}.zip" css-columns/
	rm -rf css-columns/

.PHONY: build
