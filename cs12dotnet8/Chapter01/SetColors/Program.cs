using static System.Console;

namespace SetColors
{

    internal class Program
    {
        static void Main(string[] args)
        {
            if (args.Length != 3)
            {
                WriteLine("You must specify two colors and cursor size, e.g.");
                WriteLine("setColors yellow red 50");
                return; // Stop running.
            }
            ForegroundColor = (ConsoleColor)Enum.Parse(
              enumType: typeof(ConsoleColor),
              value: args[0], ignoreCase: true);
            BackgroundColor = (ConsoleColor)Enum.Parse(
              enumType: typeof(ConsoleColor),
              value: args[1], ignoreCase: true);

            try
            {
                //this is only supported on Windows

                CursorSize = int.Parse(args[2]);
            }
            catch (PlatformNotSupportedException)
            {
                WriteLine("The current platform does not support changing the size of the cursor.");
            }

            
        }
    }
}
