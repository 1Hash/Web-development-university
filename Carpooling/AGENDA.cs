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
    
    public partial class AGENDA
    {
        public AGENDA()
        {
            this.AGENDA_USUARIOS = new HashSet<AGENDA_USUARIOS>();
        }
    
        public int idAge { get; set; }
        public System.DateTime dhAge { get; set; }
        public Nullable<int> fkCar { get; set; }
        public Nullable<int> fkDest { get; set; }
        public Nullable<int> fkUsu { get; set; }
    
        public virtual ICollection<AGENDA_USUARIOS> AGENDA_USUARIOS { get; set; }
        public virtual CARROS CARROS { get; set; }
        public virtual DESTINOS DESTINOS { get; set; }
        public virtual USUARIOS USUARIOS { get; set; }
    }
}
