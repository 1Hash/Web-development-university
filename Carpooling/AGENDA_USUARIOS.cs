//------------------------------------------------------------------------------
// <auto-generated>
//    O código foi gerado a partir de um modelo.
//
//    Alterações manuais neste arquivo podem provocar comportamento inesperado no aplicativo.
//    Alterações manuais neste arquivo serão substituídas se o código for gerado novamente.
// </auto-generated>
//------------------------------------------------------------------------------

namespace CarpoolingEL
{
    using System;
    using System.Collections.Generic;
    
    public partial class AGENDA_USUARIOS
    {
        public int idAgeUsu { get; set; }
        public Nullable<int> fkAge { get; set; }
        public Nullable<int> fkUsu { get; set; }
    
        public virtual AGENDA AGENDA { get; set; }
        public virtual USUARIOS USUARIOS { get; set; }
    }
}
