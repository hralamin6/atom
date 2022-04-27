<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Atom extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function options(Atom $atom, $field)
    {
        if ($field==='number'||$field==='mass' || $field==='boiling_point'||$field==='density'||$field==='melting_point'||$field==='id'||$field==='electron_affinity'){
            $atom = Atom::where('id', '!=', $atom->id)->where('id', '<=', $atom->id+5)->where('id', '>=', $atom->id-5)->inRandomOrder()->limit(3)->get()->merge(Atom::where('id', $atom->id)->get());
        }elseif ($field==='group'||$field==='category'||$field==='period'){
            $atom = Atom::where('id', '!=', $atom->id)->where($field, '!=', $atom[$field])->inRandomOrder()->limit(3)->get()->merge(Atom::where('id', $atom->id)->get());
        }elseif ($field==='phase'){
            $atom = Atom::where('id', '!=', $atom->id)->where($field, '!=', $atom[$field])->inRandomOrder()->limit(1)->get()->merge(Atom::where('id', $atom->id)->get());
        }elseif ($field==='name' || $field==='symbol'){
            $f = substr($atom->symbol, 0, 1);
            $atom = Atom::where('id', '!=', $atom->id)->where($field, 'like', $f.'%')->inRandomOrder()->limit(3)->get()->merge(Atom::where('id', $atom->id)->get());
        }else{
            $atom = Atom::where('id', '!=', $atom->id)->inRandomOrder()->limit(3)->get()->merge(Atom::where('id', $atom->id)->get());
        }
        return $atom->shuffle();
    }
    public function opts(Atom $atom, $field)
    {
        if ($field==='number'||$field==='mass' || $field==='boiling_point'||$field==='density'||$field==='melting_point'||$field==='id'||$field==='electron_affinity'){
            $atom = Atom::where('id', '!=', $atom->id)->where('id', '<=', $atom->id+5)->where('id', '>=', $atom->id-5)->inRandomOrder()->limit(3)->get()->merge(Atom::where('id', $atom->id)->get());
        }elseif ($field==='group'||$field==='category'||$field==='period'){
            $atom = Atom::where('id', '!=', $atom->id)->where($field, '!=', $atom[$field])->inRandomOrder()->limit(3)->get()->merge(Atom::where('id', $atom->id)->get());
        }elseif ($field==='phase'){
            $atom = Atom::where('id', '!=', $atom->id)->where($field, '!=', $atom[$field])->inRandomOrder()->limit(1)->get()->merge(Atom::where('id', $atom->id)->get());
        }elseif ($field==='name' || $field==='symbol'){
            $f = substr($atom->symbol, 0, 1);
            $atom = Atom::where('id', '!=', $atom->id)->where($field, 'like', $f.'%')->inRandomOrder()->limit(3)->get()->merge(Atom::where('id', $atom->id)->get());
        }else{
            $atom = Atom::where('id', '!=', $atom->id)->inRandomOrder()->limit(3)->get()->merge(Atom::where('id', $atom->id)->get());
        }
        return $atom->shuffle();
    }
    public function getType()
    {
        if ($this->category=='alkaline earth metal'){
            return 'text-green-400';
        }elseif($this->category=='diatomic nonmetal'){
            return 'text-accent';
        }elseif($this->category=='alkali metal'){
            return 'text-yellow-500';
        }elseif($this->category=='noble gas'){
            return 'text-orange-500';
        }elseif($this->category=='metalloid'){
            return 'text-blue-500';
        }elseif($this->category=='polyatomic nonmetal'){
            return 'text-red-500';
        }elseif($this->category=='post-transition metal'){
            return 'text-yellow-500';
        }elseif($this->category=='transition metal'){
            return 'text-pink-500';
        }elseif($this->category=='lanthanide'){
            return 'text-purple-500';
        }elseif($this->category=='actinide'){
            return 'text-indigo-500';
        }else{
            return 'text-gray-500';
        }
    }
}
