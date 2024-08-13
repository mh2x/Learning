namespace ShareNow.Utils
{
    public class Singleton<T> where T : class
    {
        private static readonly Lazy<T> instance = new (() =>
        {
            return Activator.CreateInstance(typeof(T), true) as T;
        });

        public static T Instance => instance.Value;

        protected Singleton()
        {
        }
    }
}

//End Singleton.cs