using static System.Console;

//Code can have overflow
//Checked will throw runtime exception to detect overflow
//To disable compile-time overflow checks, use unchecked

namespace CheckedUnchecked
{
    internal class Program
    {
        static void Main(string[] args)
        {
            try
            {
                //This code silently overflows without us noticing
                int x = int.MaxValue - 1;
                WriteLine($"Initial value: {x}");
                x++;
                WriteLine($"After incrementing: {x}");
                x++;
                WriteLine($"After incrementing: {x}");
                x++;
                WriteLine($"After incrementing: {x}");
            }
            catch(Exception ex)
            {
                WriteLine($"PART1: {ex.GetType()} says {ex.Message}");
            }

            try
            {
                //This throws runtime exception!
                DoChecked();
            }
            catch (Exception ex)
            {
                WriteLine($"PART2: {ex.GetType()} says {ex.Message}");
            }

            try
            {
                DoUnchecked();

            }
            catch (Exception ex)
            {
                WriteLine($"PART3: {ex.GetType()} says {ex.Message}");
            }
            
        }
        static void DoChecked()
        {
            checked
            {
                int x = int.MaxValue - 1;
                WriteLine($"Initial value: {x}");
                x++;
                WriteLine($"After incrementing: {x}");
                x++;
                WriteLine($"After incrementing: {x}");
                x++;
                WriteLine($"After incrementing: {x}");
            }
        }
        static void DoUnchecked()
        {
            //NOTE: test this by commenting out unchecked
/*
 * Of course, it would be rare that you would want to explicitly 
 * switch off a check like this because it allows an overflow to occur. 
 * But perhaps you can think of a scenario where you might want that behavior.
 * */
unchecked
{
    int y = int.MaxValue + 1;
    WriteLine($"Initial value: {y}");
    y--;
    WriteLine($"After decrementing: {y}");
    y--;
    WriteLine($"After decrementing: {y}");
}
}
}
}
