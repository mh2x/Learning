using static System.Console;

namespace CatchExceptions
{
    internal class Program
    {
        static void Main(string[] args)
        {
            WriteLine("Before parsing");
            Write("What is your age? ");
            string? input = ReadLine();
            try
            {
                int age = int.Parse(input);
                WriteLine($"You are {age} years old.");
            }
            //this is bad, don't do it!
            //catch
            //{
            //}

            catch (FormatException)
            {
                WriteLine("The age you entered is not a valid number format.");
            }
            catch (Exception ex)
            {
                WriteLine($"{ex.GetType()} says {ex.Message}");
            }

            WriteLine("After parsing...done");

            //Using filters with exceptions
            Write("Enter an amount: ");
            string amount = ReadLine()!;
            if (string.IsNullOrEmpty(amount)) return;
            try
            {
                decimal amountValue = decimal.Parse(amount);
                WriteLine($"Amount formatted as currency: {amountValue:C}");
            }
            catch (FormatException) when (amount.Contains("$"))
            {
                WriteLine("Amounts cannot use the dollar sign!");
            }
            catch (FormatException)
            {
                WriteLine("Amounts must only contain digits!");
            }
        }
    }
}
