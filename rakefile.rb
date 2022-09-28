require 'rake'

def create
  if @sub
    p "created"
  else
    p 'cant cleated'
  end
end

task :prepare do
  @sub = 'paper'
  p 'prepare'
end

task :twice_create do
  Rake::Task['prepare'].invoke
  Rake::Task['create'].invoke
  create
end

task :create do
  Rake::Task['prepare'].invoke
  create
end

task :noprepare_create do
  create
end