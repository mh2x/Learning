// See https://aka.ms/new-console-template for more information

#region Show compiler version
//Ucomment to show the compiler version
//#error version
#endregion

using System;
using System.Net.NetworkInformation;
using System.Reflection;
using Vocabulary;
using static System.Runtime.InteropServices.JavaScript.JSType;

Console.WriteLine("Hello, World!");
//Look at project file for this
//We added the following line:
//< ItemGroup >
//    < Using Remove = "System.Threading" />
//    < Using Include = "System.Numerics" />
//    < Using Include = "System.Console" Static = "true" />
//    < Using Include = "System.Environment" Alias = "Env" />
//  </ ItemGroup >
WriteLine($"Computer named {Env.MachineName} says \"No.\"");

//Reflection 
//Why does the System.Runtime assembly contain zero types?
//This assembly is special because it contains only type-forwarders
//rather than actual types. A type-forwarder represents a type that has
//been implemented outside of .NET or for some other advanced reason.

ReflectionExample.DemoReflection();

//
// Display Emojis
//
Console.OutputEncoding = System.Text.Encoding.UTF8;
string grinningEmoji = char.ConvertFromUtf32(0x1F600);
Console.WriteLine(grinningEmoji);

//Verbatim strings
string filePath = @"C:\televisions\sony\bravia.txt";


//
// Raw string literals  in C#11
//
/*Introduced in C# 11, raw string literals are convenient for entering any arbitrary text without needing to escape the contents. They make it easy to define literals containing other languages like XML, HTML, or JSON.
  Raw string literals start and end with three or more double-quote characters, as shown in the following code:
*/
string xml = """
             <person age="50">
               <first_name>Mark</first_name>
             </person>
             """;


/*Raw interpolated string literals
You can mix interpolated strings that use curly braces { } with raw string 
literals. You specify the number of braces that indicates a replaced 
expression by adding that number of dollar signs to the start of the 
literal. Any fewer braces than that are treated as raw content.

For example, if we want to define some JSON, single braces will be treated 
as normal braces, but the two dollar symbols tell the compiler that any 
two curly braces indicate a replaced expression value, as shown in the following 
code:
*/

var person = new { FirstName = "Alice", Age = 56 };
string json = $$"""
              {
                "first_name": "{{person.FirstName}}",
                "age": {{person.Age}},
                "calculation": "{{{1 + 2}}}"
              }

              """;
Console.WriteLine(json);

//Improving legibility by using digit separators C# 7+
int num = 10_00_000;  //you can also use binary 0b or hex 0x

int decimalNotation = 2_000_000;
int binaryNotation = 0b_0001_1110_1000_0100_1000_0000;
int hexadecimalNotation = 0x_001E_8480;

Console.WriteLine($"10_00_000 is {num}");
Console.WriteLine($"{decimalNotation == binaryNotation}");
Console.WriteLine($"{decimalNotation == hexadecimalNotation}");

//Writing code to explore number sizes
Console.WriteLine($"int uses {sizeof(int)} bytes and can store numbers in the range {int.MinValue:N0} to {int.MaxValue:N0}.");
Console.WriteLine($"double uses {sizeof(double)} bytes and can store numbers in the range {double.MinValue:N0} to {double.MaxValue:N0}.");
Console.WriteLine($"decimal uses {sizeof(decimal)} bytes and can store numbers in the range {decimal.MinValue:N0} to {decimal.MaxValue:N0}.");


/* Allowing unsafe code
 * <PropertyGroup>
  <OutputType>Exe</OutputType>
  <TargetFramework>net8.0</TargetFramework>
  <ImplicitUsings>enable</ImplicitUsings>
  <Nullable>enable</Nullable>
  <AllowUnsafeBlocks>True</AllowUnsafeBlocks>
</PropertyGroup>
 */

/*
unsafe
{
    Console.WriteLine($"Half uses {sizeof(Half)} bytes");
}
*/


//Dynamic in C# 4 for DLR, expensive to use
dynamic something;
// Storing an array of int values in a dynamic object.
// An array of any type has a Length property.
something = new[] { 3, 5, 7 };
// Storing an int in a dynamic object.
// int does not have a Length property.
something = 12;
// Storing a string in a dynamic object.
// string has a Length property.
something = "Ahmed";
// This compiles but might throw an exception at run-time.
Console.WriteLine($"The length of something is {something.Length}");
// Output the type of the something variable.
Console.WriteLine($"something is a {something.GetType()}");

//var keyword and inferring type
var population = 67_000_000; // 67 million in UK.
var weight = 1.88; // in kilograms.
var price = 4.99M; // in pounds sterling.
var fruit = "Apples"; // string values use double-quotes.
var letter = 'Z'; // char values use single-quotes.
var happy = true; // Booleans can only be true or false.
//NOTE: Try ALT+F1 here :)

//target-typed new to instantiate objects
DateTime date1 = new DateTime(1973, 8, 12); //old way
DateTime date2 = new (1973, 8, 12); //new way in C# 9 or later

//
// Default value for each type
//
Console.WriteLine($"default(int) = {default(int)}");
Console.WriteLine($"default(bool) = {default(bool)}");
Console.WriteLine($"default(DateTime) = {default(DateTime)}");
Console.WriteLine($"default(string) = {default(string)}");

int number = 13;
Console.WriteLine($"number set to: {number}");
number = default;
Console.WriteLine($"number reset to its default: {number}");

//NOTE : Interpolated strings using $ was introduced in C#6
//If you are writing code that will be part of a Unity project, then
//interpolated string formats is an easy way to avoid boxing.


//
// Getting key input from the user
// Note that we have imported static class using
// using static System.Console;

Write("Press any key combination: ");
ConsoleKeyInfo key = ReadKey();
WriteLine();
WriteLine("Key: {0}, Char: {1}, Modifiers: {2}",
          arg0: key.Key, arg1: key.KeyChar, arg2: key.Modifiers);
//Note: it is not recommmended to use arg0: arg1:... it is just for learning

//End of Program.cs
