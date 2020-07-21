# Dead Simple API Simulator
This is an extremely basic website meant to act as an API simulator. You run it on your machine at localhost:8080 (or whatever you prefer), point your app/framework at it and check to see exactly what parameters are received.

I use this when preparing API testing tools to make sure that the tool is building the request in the way that I expect. You can also use it to test HTML forms or any other link builder.

I maintain a Docker Hub image of this so usage is a simple as:
```docker run -p 127.0.0.1:8080:80 --rm --name api-test-backend docker.io/patricktcb/api-sim:latest```

The actual webpage is a modified version of the [Clean Blog](https://startbootstrap.com/themes/clean-blog/) bootstrap theme.