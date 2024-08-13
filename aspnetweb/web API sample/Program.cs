/// <summary>
/// Sample based on MSDN article: https://learn.microsoft.com/en-us/training/modules/build-web-api-aspnet-core/3-exercise-create-web-api 
/// This can be used in conjunction with the ContosoPizza Razor pages project
/// Created by Mh2x on July 5th, 2024
/// Project structure:
/// 
/// Controllers/	        Contains classes with public methods exposed as HTTP endpoints.
/// Program.cs              Configures services and the app's HTTP request pipeline, and contains the app's managed entry point.
/// .csproj	    Contains configuration metadata for the project.
//  .http	    Contains configuration to test REST APIs directly from Visual Studio Code.
///
/// If you have experience with Razor Pages or model-view-controller (MVC) architecture development in ASP.NET Core, you've used the Controller class. 
/// Don't create a web API controller by deriving from the Controller class. Controller derives from ControllerBase and adds support for views,
/// so it's for handling webpages, not web API requests.
/// <returns></returns>
var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
builder.Services.AddControllers();
// Learn more about configuring Swagger/OpenAPI at https://aka.ms/aspnetcore/swashbuckle
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

var app = builder.Build();

// Configure the HTTP request pipeline.
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}

//Look at Enforce HTTPS in ASP.NET Core: https://learn.microsoft.com/en-us/aspnet/core/security/enforcing-ssl?view=aspnetcore-8.0&tabs=visual-studio%2Clinux-ubuntu#trust-the-aspnet-core-https-development-certificate-on-windows-and-macos

app.UseHttpsRedirection();

app.UseAuthorization();

app.MapControllers();

app.Run();
