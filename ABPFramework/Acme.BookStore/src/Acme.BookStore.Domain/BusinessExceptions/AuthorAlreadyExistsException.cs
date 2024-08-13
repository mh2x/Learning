using Acme.BookStore.ErrorCodes;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Volo.Abp;

namespace Acme.BookStore.BusinessExceptions
{
    public class AuthorAlreadyExistsException : BusinessException
    {
        public AuthorAlreadyExistsException(string name)
            : base(BookStoreDomainErrorCodes.AuthorAlreadyExists)
        {
            //BusinessException is automatically handled by the ABP Framework 
            //and can be easily localized. WithData(...) method is used 
            //to provide additional data to the exception object 
            //that will later be used on the localization message 
            //or for some other purpose.
            WithData("name", name);
        }
    }
}