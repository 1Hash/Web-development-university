using System;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web.Mvc;

namespace CarpoolingEL.Controllers
{
    public class PassageiroController : Controller
    {

        private CarpoolingELEntities db = new CarpoolingELEntities();

        // GET: Passageiro
        public ActionResult Index()
        {
            var aGENDA = db.AGENDA.Include(a => a.CARROS).Include(a => a.DESTINOS).Include(a => a.USUARIOS).Include(au => au.AGENDA_USUARIOS);
            return View(aGENDA.ToList());
        }

        public ActionResult Create([Bind(Include = "idAgeUsu,fkAge,fkUsu")] AGENDA_USUARIOS aGENDA_USUARIOS)
        {
            if (ModelState.IsValid)
            {
                db.AGENDA_USUARIOS.Add(aGENDA_USUARIOS);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.fkAge = new SelectList(db.AGENDA, "idAge", "idAge", aGENDA_USUARIOS.fkAge);
            ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu", aGENDA_USUARIOS.fkUsu);
            return View(aGENDA_USUARIOS);
        }

        public ActionResult Sair(int? id)
        {
            AGENDA_USUARIOS aGENDA_USUARIOS = db.AGENDA_USUARIOS.Find(id);
            db.AGENDA_USUARIOS.Remove(aGENDA_USUARIOS);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        public ActionResult Configuracoes()
        {
            int v = Convert.ToInt32(Session["UserID"]);
            USUARIOS uSUARIOS = db.USUARIOS.Find(v);
            return View(uSUARIOS);
        }

        public ActionResult Editar()
        {

            int v = Convert.ToInt32(Session["UserID"]);

            USUARIOS uSUARIOS = db.USUARIOS.Find(v);
            if (uSUARIOS == null)
            {
                return HttpNotFound();
            }
            ViewBag.fkTipo = new SelectList(db.TIPO_USUARIO, "idTipoUser", "idTipoUser", uSUARIOS.fkTipo);
            return View(uSUARIOS);
        }

        [HttpPost]
        public ActionResult Editar([Bind(Include = "idUsu,nomeUsu,emailUsu,rgUsu,endUsu,compUsu,cepUsu,bairroUsu,cidadeUsu,ufUsu,telUsu,celUsu,usuario,senha,fkTipo")] USUARIOS uSUARIOS)
        {
            if (ModelState.IsValid)
            {
                db.Entry(uSUARIOS).State = EntityState.Modified;
                db.SaveChanges();
                Session["msgedit"] = "Seus dados foram alterados com sucesso!";
                return RedirectToAction("Configuracoes");
            }
            ViewBag.fkTipo = new SelectList(db.TIPO_USUARIO, "idTipoUser", "idTipoUser", uSUARIOS.fkTipo);
            return View(uSUARIOS);
        }
    }
}