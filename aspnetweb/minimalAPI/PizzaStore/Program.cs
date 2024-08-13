using Microsoft.OpenApi.Models;
using PizzaStore.Models;
using PizzaStore.Data;
using Microsoft.EntityFrameworkCore.Sqlite;
using Microsoft.EntityFrameworkCore;
using PizzaStore.Services;
using Microsoft.AspNetCore.Mvc.Routing;

var builder = WebApplication.CreateBuilder(args);
//Things we can add:
//1- DB connection
var connectionString = builder.Configuration.GetConnectionString("Pizzas") ?? "Data Source=Pizzas.db";
builder.Services.AddSqlite<PizzaDB>(connectionString);
//Add our DB Service
builder.Services.AddScoped<IPizzaService, PizzaDBService>();

// 2- Add CORS
builder.Services.AddCors(options => { });

//3- Add swagger
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen(c =>
{
    c.SwaggerDoc("v1", new OpenApiInfo
    {
        Title = "PizzaStore API",
        Description = "Making the Pizzas you love",
        Version = "v1"
    });
});

//4- To show our own UI, we will use razor pages
builder.Services.AddRazorPages();
//5- for the UI to access the server API, we will need an httpclient 
// Add IHttpClientFactory to the container and sets the name of the factory
// to "FruitAPI", and the also sets the base address used in calls

//See: https://swimburger.net/blog/dotnet/how-to-get-aspdotnet-core-server-urls
var appUrls = builder.Configuration["ASPNETCORE_URLS"];
var serverUrl = appUrls.Split(';').Last().TrimEnd('/');

builder.Services.AddHttpClient("PizzaAPIClient", httpClient =>
{
    httpClient.BaseAddress = new Uri(serverUrl);
});

//The following code displays the environment variables 
//and values on application startup, which can be helpful when debugging environment settings
foreach (var c in builder.Configuration.AsEnumerable())
{
    Console.WriteLine(c.Key + " = " + c.Value);
}

var app = builder.Build();

//5- Show Swagger UI in dev mode
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI(c =>
    {
        c.SwaggerEndpoint("/swagger/v1/swagger.json", "PizzaStore API V1");
    });
}

//Route /
//app.MapGet("/", () => "Hello World!");
//6- Route our Pizza API endpoints
app.MapPizzaEndPoints();

//Use CORs middleware
/*
Middleware is usually code that intercepts the request and 
carries out checks like checking for authentication or 
ensuring the client is allowed to perform this operation 
according to CORS. After the middleware is done executing,
 the actual request is carried out. Data is either read 
 or written to the store and a response is sent back to 
 the calling client.
*/
app.UseCors("some unique string");

//Need to also map razor pages
app.MapRazorPages();

//Run our app
app.Run();
