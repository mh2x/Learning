using System.Globalization; // To use CultureInfo.
using static System.Console;

namespace CultureInfoDemo
{
    internal class Program
    {
        static void Main(string[] args)
        {
            // Set the current culture to make sure date parsing works.
            CultureInfo.CurrentCulture = CultureInfo.GetCultureInfo("en-US");
            int friends = int.Parse("27");
            DateTime birthday = DateTime.Parse("4 June 1980");
            WriteLine($"I have {friends} friends to invite to my party.");
            WriteLine($"My birthday is {birthday}.");
            WriteLine($"My birthday is {birthday:D}.");

            //Good Practice: Use the standard date and time format specifiers, as shown
            //at the following link:
            //https://learn.microsoft.com/en-us/dotnet/standard/base-types/standard-date-and-time-format-strings#table-of-format-specifiers.


            //FR culture
            //ConfigureConsole();
            ConfigureConsole(culture: "fr-FR");

            decimal taxToPay = CalculateTax(amount: 149, twoLetterRegionCode: "FR");
            WriteLine($"You must pay {taxToPay:C} in tax.");
        }

        static decimal CalculateTax(decimal amount, string twoLetterRegionCode)
        {
            decimal rate = twoLetterRegionCode switch
            {
                "CH" => 0.08M, // Switzerland
                "DK" or "NO" => 0.25M, // Denmark, Norway  
                "GB" or "FR" => 0.2M, // UK, France
                "HU" => 0.27M, // Hungary
                "OR" or "AK" or "MT" => 0.0M, // Oregon, Alaska, Montana
                "ND" or "WI" or "ME" or "VA" => 0.05M,
                "CA" => 0.0825M, // California
                _ => 0.06M // Most other states.
            };
            return amount * rate;
        }

        static void ConfigureConsole(string culture = "en-US", bool useComputerCulture = false)
        {
            // To enable Unicode characters like Euro symbol in the console.
            OutputEncoding = System.Text.Encoding.UTF8;
            if (!useComputerCulture)
            {
                CultureInfo.CurrentCulture = CultureInfo.GetCultureInfo(culture);
            }
            WriteLine($"CurrentCulture: {CultureInfo.CurrentCulture.DisplayName}");
        }
    }


}
