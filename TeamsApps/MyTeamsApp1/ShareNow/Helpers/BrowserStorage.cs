
using Blazored.LocalStorage; //https://github.com/Blazored/LocalStorage
using ShareNow.Utils;

namespace ShareNow.Helpers
{
    public class BrowserStorage
    {
        private readonly ILocalStorageService _localStorage = null;


        public BrowserStorage(ILocalStorageService localStorage)
        {
            _localStorage = localStorage;
        }

        public async Task WriteAsync(string key, string value)
        {
            await _localStorage.SetItemAsync(key, value);
        }

        public async Task<string?> ReadAsync(string key)
        {
            return await _localStorage.GetItemAsync<string>(key);
        }


        public async Task<string> GetAsync(string name)
        {
            string result = await _localStorage.GetItemAsync<string>(name);
            return result;
        }

        public async void SetAsync<T>(string name, T value)
        {
            await _localStorage.SetItemAsync(name, value);
        }

        //TODO: add support for cookies:
        /*
         *   JSRuntime.InvokeAsync<string>("setCookie", "key", "va", exp);
         *   var result = await JSRuntime.InvokeAsync<string>("getCookie", "name");
         */
    }
}

//End BrowserStorage.cs
