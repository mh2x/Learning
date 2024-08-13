using static System.Console;

/*
 * In C# 7 and later, your code can more concisely branch, based on the 
 * subtype of a class, and you can declare and assign a local variable to 
 * safely use it. Additionally, case statements can include a when keyword to 
 * perform more specific pattern matching.
 */ 
namespace SwitchAnimalCast
{
    class Animal // This is the base type for all animals.
    {
        public string? Name;
        public DateTime Born;
        public byte Legs;
    }
    class Cat : Animal // This is a subtype of animal.
    {
        public bool IsDomestic;
    }
    class Spider : Animal // This is another subtype of animal.
    {
        public bool IsPoisonous;
    }

    internal class Program
    {
        static void Main(string[] args)
        {
            var animals = new Animal?[]
{
  new Cat { Name = "Karen", Born = new(year: 2022, month: 8,
    day: 23), Legs = 4, IsDomestic = true },
  null,
  new Cat { Name = "Mufasa", Born = new(year: 1994, month: 6,
    day: 12) },
  new Spider { Name = "Sid Vicious", Born = DateTime.Today,
    IsPoisonous = true},
  new Spider { Name = "Captain Furry", Born = DateTime.Today }
};
            foreach (Animal? animal in animals)
            {
                string message;
                switch (animal)
                {
                    case Cat fourLeggedCat when fourLeggedCat.Legs == 4:
                        message = $"The cat named {fourLeggedCat.Name} has four legs.";
                        break;
                    case Cat wildCat when wildCat.IsDomestic == false:
                        message = $"The non-domestic cat is named {wildCat.Name}.";
                        break;
                    case Cat cat:
                        message = $"The cat is named {cat.Name}.";
                        break;
                    default: // default is always evaluated last.
                        message = $"{animal.Name} is a {animal.GetType().Name}.";
                        break;
                    case Spider spider when spider.IsPoisonous:
                        message = $"The {spider.Name} spider is poisonous. Run!";
                        break;
                    case null:
                        message = "The animal is null.";
                        break;
                }
                WriteLine($"switch statement: {message}");

                //In C# 8 or later, you can simplify switch statements using switch expressions.
                message = animal switch
                {
                    Cat fourLeggedCat when fourLeggedCat.Legs == 4
                      => $"The cat named {fourLeggedCat.Name} has four legs.",
                    Cat wildCat when wildCat.IsDomestic == false
                      => $"The non-domestic cat is named {wildCat.Name}.",
                    Cat cat
                      => $"The cat is named {cat.Name}.",
                    Spider spider when spider.IsPoisonous
                      => $"The {spider.Name} spider is poisonous. Run!",
                    null
                      => "The animal is null.",
                    _
                      => $"{animal.Name} is a {animal.GetType().Name}."
                };
                WriteLine($"switch expression: {message}");

            }
        }
    }
}

