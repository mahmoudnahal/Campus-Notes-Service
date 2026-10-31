# Technical Notes

## Biggest Docker problem and how I solved it

The first `docker build` took more than an hour because the base image
`php:8.2-apache` had to be downloaded over a slow connection. I did not cancel it,
and the image is now cached, so later builds finish in seconds.

I also confused the two port numbers at first. In `-p 8000:80`, 8000 is the port on my
computer and 80 is the port Apache listens on inside the container, so the
Dockerfile needs `EXPOSE 80`, not `EXPOSE 8000`.

## Most important Git/GitHub lesson

Write small commits with clear messages (`feat:`, `docker:`, `docs:`) so the history
shows the real progress of the work. I also learned to check that the remote URL
has my real GitHub username, because a placeholder URL makes `git push` fail with
"Repository not found".
