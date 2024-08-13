// C# 10 introduced a new keyword combination and .NET SDK 6
// introduced a new project setting that works together to simplify importing common
// namespaces.

//NOTE: it is recommended to create a separate file for those
//statements named something like GlobalUsings.cs
//with the contents being all your global using statements, as shown in the
//following code:

global using System;
global using System.Linq;
global using System.Collections.Generic;


namespace Vocabulary
{
    internal class Cs10_net6_global
    {
    }
}
