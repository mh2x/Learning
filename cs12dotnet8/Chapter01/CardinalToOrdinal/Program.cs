using static System.Console;

namespace CardinalToOrdinal
{
    internal class Program
    {
        static void Main(string[] args)
        {
            for (uint number = 1; number <= 110; number++)
            {
                Write($"{CardinalToOrdinal(number)} ");
            }
            WriteLine();
        }

        /// <summary>
        /// Pass a 32-bit unsigned integer and it will be converted into its ordinal equivalent.
        /// </summary>
        /// <param name="number">Number as a cardinal value e.g. 1, 2, 3, and so on.</param>
        /// <returns>Number as an ordinal value e.g. 1st, 2nd, 3rd, and so on.</returns>
        static string CardinalToOrdinal(uint number)
        {
            uint lastTwoDigits = number % 100;
            switch (lastTwoDigits)
            {
                case 11: // Special cases for 11th to 13th.
                case 12:
                case 13:
                    return $"{number:N0}th";
                default:
                    uint lastDigit = number % 10;
                    string suffix = lastDigit switch
                    {
                        1 => "st",
                        2 => "nd",
                        3 => "rd",
                        _ => "th"
                    };
                    return $"{number:N0}{suffix}";
            }
        }
    }
}
