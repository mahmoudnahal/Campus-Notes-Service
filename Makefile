IMAGE = campus-notes-service
NAME  = campus-notes

build:
	docker build -t $(IMAGE) .

run:
	docker run -d --name $(NAME) -p 8000:80 -v notes-data:/data $(IMAGE)

stop:
	docker rm -f $(NAME)

logs:
	docker logs $(NAME)

.PHONY: build run stop logs